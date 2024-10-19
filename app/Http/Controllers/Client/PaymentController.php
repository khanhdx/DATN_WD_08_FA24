<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Color;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use App\Models\StatusOrderDetail;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        // Kiểm tra nếu đã đăng nhập
        if (auth()->check()) {
            // Nếu đã đăng nhập, lấy giỏ hàng từ cơ sở dữ liệu
            $cart = Cart::where('user_id', auth()->id())->first();
            $cartId = $cart ? $cart->id : null;
        } else {
            // Nếu chưa đăng nhập, lấy cart_id từ session
            $cartId = Session::get('cart_id');
        }

        // Kiểm tra xem giỏ hàng có tồn tại không
        if (!$cartId) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        // Lấy dữ liệu từ giỏ hàng
        $cartItems = CartItem::where('cart_id', $cartId)->with('productVariant')->get();

        // Kiểm tra xem giỏ hàng có chứa sản phẩm không
        if ($cartItems->isEmpty()) {
            return redirect()->route('home')->with('error', 'Giỏ hàng trống.');
        }

        // Hiển thị form thanh toán và truyền biến cartItems
        return view('client.checkouts.index', compact('cartItems'));
    }

    public function checkout(Request $request)
    {
        // Kiểm tra nếu đã đăng nhập
        if (auth()->check()) {
            $cart = Cart::where('user_id', auth()->id())->first();
            $cartId = $cart ? $cart->id : null;
        } else {
            $cartId = Session::get('cart_id');
        }

        // Kiểm tra xem giỏ hàng có tồn tại không
        if (!$cartId) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        // Lấy cart từ database
        $cart = Cart::find($cartId);
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        // Lấy tất cả cart_items cho cart
        $cartItems = CartItem::where('cart_id', $cartId)->with('productVariant')->get();

        // Kiểm tra xem giỏ hàng có chứa sản phẩm không
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        // Tính tổng giá trị
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $productVariant = $item->productVariant;
            $detailTotalPrice = $item->quantity * $productVariant->price;
            $totalPrice += $detailTotalPrice;
        }

        // Kiểm tra mã giảm giá và áp dụng nếu có
        $discount = 0;
        if ($request->has('voucher_id')) {
            $voucher = Voucher::find($request->voucher_id);
            if ($voucher && $voucher->status == 'Đang diễn ra' && $voucher->date_start <= now() && $voucher->date_end >= now()) {
                // Áp dụng mã giảm giá
                $discount = $voucher->decreased_value;
                // Giảm tổng giá trị đơn hàng
                $totalPrice -= $discount;
            }
        }

        // Đảm bảo tổng giá trị không âm
        $totalPrice = max(0, $totalPrice);

        // Lưu đơn hàng vào database
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice, // Lưu giá trị tổng tiền đã giảm
            'voucher_id' => $request->voucher_id, // Nếu có
            'status_order_id' => 1, // Mặc định trạng thái là "processing"
            'date' => now(),
            'address' => $request->address,
        ]);

        // Lưu các chi tiết đơn hàng
        foreach ($cartItems as $item) {
            $productVariant = $item->productVariant;
            $detailTotalPrice = $item->quantity * $productVariant->price;

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productVariant->product_id,
                'product_variant_id' => $productVariant->id,
                'name_product' => $productVariant->product->name,
                'color' => $productVariant->color->name ?? null,
                'size' => $productVariant->size->name ?? null,
                'unit_price' => $productVariant->price,
                'quantity' => $item->quantity,
                'total_price' => $detailTotalPrice, // Có thể cần cập nhật nếu muốn lưu giá trị đã giảm
            ]);
        }

        // Tạo bản ghi trạng thái đơn hàng
        StatusOrderDetail::create([
            'status_order_id' => 1, // ID trạng thái "processing"
            'order_id' => $order->id,
            'name' => 'Đơn hàng mới',
        ]);

        // Xóa giỏ hàng sau khi thanh toán
        CartItem::where('cart_id', $cartId)->delete();

        // Lưu thông tin thanh toán
        Payment::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'amount' => $totalPrice,
            'transaction_type' => 0,
            'payment_method' => $request->payment_method,
            'status' => 0,
        ]);

        return redirect()->route('payment.success')->with('success', 'Đặt hàng thành công!');
    }

    public function applyVoucher(Request $request)
    {
        // Validate mã giảm giá từ request
        $request->validate([
            'voucher_code' => 'required|string',
        ]);

        // Tìm mã giảm giá trong database
        $voucher = Voucher::where('voucher_code', $request->voucher_code)
            ->where('status', 'Đang diễn ra')
            ->where('date_start', '<=', now())
            ->where('date_end', '>=', now())
            ->first();

        if ($voucher) {
            // Lưu mã vào session
            session(['voucher_code' => $request->voucher_code]);

            // Chuyển hướng về trang thanh toán
            return redirect()->route('payment.form')->with('success', 'Mã giảm giá đã được áp dụng!');
        }

        return redirect()->route('payment.form')->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
    }

    public function paymentSuccess()
    {
        if (auth()->check()) {
            $orders = Order::where('user_id', auth()->id())->latest()->first();
            if (!$orders) {
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }
            return view('client.checkouts.success', compact('orders'));
        } else {
            if (!session()->has('order')) {
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }
            $orders = session('order');
            return view('client.checkouts.success', compact('orders'));
        }
    }
}
