<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\StatusOrderDetail;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        // Kiểm tra nếu đã đăng nhập và lấy cart_id
        $cartId = auth()->check() ? Cart::where('user_id', auth()->id())->value('id') : Session::get('cart_id');

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
        // Validate các trường cần thiết
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
            'voucher_id' => 'nullable|exists:vouchers,id',
        ]);

        // Kiểm tra và lấy cart_id
        $cartId = auth()->check() ? Cart::where('user_id', auth()->id())->value('id') : Session::get('cart_id');

        // Kiểm tra xem giỏ hàng có tồn tại không
        if (!$cartId) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        // Lấy tất cả cart_items cho cart
        $cartItems = CartItem::where('cart_id', $cartId)->with('productVariant')->get();

        // Kiểm tra xem giỏ hàng có chứa sản phẩm không
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        // Tính tổng giá trị
        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * $item->productVariant->price;
        });

        // Kiểm tra mã giảm giá và áp dụng nếu có
        $discount = 0;
        if ($request->filled('voucher_id')) {
            $voucher = Voucher::find($request->voucher_id);
            if ($voucher && $voucher->status === 'Đang diễn ra' && $voucher->date_start <= now() && $voucher->date_end >= now()) {
                // Áp dụng mã giảm giá
                $discount = $voucher->decreased_value;
                // Giảm tổng giá trị đơn hàng
                $totalPrice -= $discount;
            }
        }

        // Đảm bảo tổng giá trị không âm
        $totalPrice = max(0, $totalPrice);

        // Lưu đơn hàng vào database
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'voucher_id' => $request->voucher_id,
                'status_order_id' => 1, // Trạng thái mặc định
                'date' => now(),
                'address' => $request->address,
            ]);

            // Lưu các chi tiết đơn hàng
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->productVariant->product_id,
                    'product_variant_id' => $item->productVariant->id,
                    'name_product' => $item->productVariant->product->name,
                    'color' => $item->productVariant->color->name ?? null,
                    'size' => $item->productVariant->size->name ?? null,
                    'unit_price' => $item->productVariant->price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->quantity * $item->productVariant->price,
                ]);
            }

            // Tạo bản ghi trạng thái đơn hàng
            StatusOrderDetail::create([
                'status_order_id' => 1, // ID trạng thái "processing"
                'order_id' => $order->id,
                'name' => 'Đơn hàng mới',
            ]);

            // Lưu thông tin thanh toán
            Payment::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'amount' => $totalPrice,
                'transaction_type' => 0,
                'payment_method' => $request->payment_method,
                'status' => 0,
            ]);
        } catch (\Exception $e) {
            Log::error('Error while creating order: '.$e->getMessage());
            return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra khi lưu đơn hàng. Vui lòng thử lại.');
        }

        // Xóa giỏ hàng sau khi thanh toán
        CartItem::where('cart_id', $cartId)->delete();

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
            session(['voucher_id' => $voucher->id]);

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
