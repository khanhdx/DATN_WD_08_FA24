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
use App\Models\VoucherWare;
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
            return redirect()->route('client.home')->with('error', 'Giỏ hàng trống.');
        }

        // Hiển thị form thanh toán và truyền biến cartItems
        return view('client.checkouts.index', compact('cartItems'));
    }
    public function processVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
        ]);

        $voucher = Voucher::where('voucher_code', $request->voucher_code)->first();

        if ($request->action === 'apply') {
            if ($voucher) {
                $voucherUsed = VoucherWare::where('user_id', auth()->id())
                    ->where('voucher_id', $voucher->id)
                    ->exists();

                if ($voucherUsed) {
                    return redirect()->route('checkout')->with('error', 'Bạn đã sử dụng mã giảm giá này trước đây.');
                }

                if ($voucher->status === 'Đang diễn ra' && $voucher->date_start <= now() && $voucher->date_end >= now()) {
                    Log::info('Voucher found:', [
                        'id' => $voucher->id,
                        'decreased_value' => $voucher->decreased_value,
                        'status' => $voucher->status,
                    ]);

                    session(['voucher_id' => $voucher->id, 'discount' => $voucher->decreased_value]);

                    return redirect()->route('checkout')->with('success', 'Mã giảm giá đã được áp dụng!');
                }
                return redirect()->route('checkout')->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
            }

            return redirect()->route('checkout')->with('error', 'Mã giảm giá không hợp lệ.');
        }

        if ($request->action === 'cancel') {
            if (!$voucher) {
                return redirect()->route('checkout')->with('error', 'Mã giảm giá không hợp lệ.');
            }

            $isUsed = Order::where('voucher_id', $voucher->id)->exists();
            if ($isUsed) {
                return redirect()->route('checkout')->with('error', 'Voucher đã được sử dụng và không thể hủy.');
            }

            $voucher->quanlity += 1;
            $voucher->save();

            session()->forget('voucher_id');
            session()->forget('discount');

            return redirect()->route('checkout')->with('success', 'Voucher đã được hủy thành công!');
        }

        return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra.');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $cartId = auth()->check() ? Cart::where('user_id', auth()->id())->value('id') : Session::get('cart_id');

        if (!$cartId) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        $cartItems = CartItem::with('productVariant')->where('cart_id', $cartId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        // Tính toán tổng giá trị đơn hàng
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->totalPrice(); // Sử dụng phương thức totalPrice để lấy giá trị
        }

        // Kiểm tra voucher và áp dụng giảm giá nếu có
        $voucherDiscount = session('discount', 0);
        $totalPrice -= $voucherDiscount; // Giảm giá trị nếu có voucher

        // Đảm bảo tổng giá không âm
        $totalPrice = max($totalPrice, 0);

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'voucher_id' => session('voucher_id'), // Lưu voucher_id từ session
                'status_order_id' => 1,
                'date' => now(),
                'address' => $request->address,
            ]);

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
                    'total_price' => $item->totalPrice(), // Sử dụng phương thức totalPrice
                ]);
            }

            // Lưu trạng thái đơn hàng
            StatusOrderDetail::create([
                'status_order_id' => 1, // Trạng thái là "đang xử lý"
                'order_id' => $order->id,
                'name' => '',
            ]);

            Payment::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'amount' => $totalPrice,
                'transaction_type' => 0,
                'payment_method' => $request->payment_method,
                'status' => 0,
            ]);
        } catch (\Exception $e) {
            Log::error('Error while creating order: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra khi lưu đơn hàng. Vui lòng thử lại.');
        }
        // Kiểm tra voucher nếu có và trừ số lượng
        $voucherId = session('voucher_id');
        if ($voucherId) {
            $voucher = Voucher::find($voucherId);
            if ($voucher && $voucher->quanlity > 0) {
                $voucher->quanlity -= 1; // Giảm số lượng voucher
                $voucher->save();

                // Lưu vào bảng voucher_wares
                VoucherWare::create([
                    'user_id' => auth()->id(),
                    'voucher_id' => $voucher->id,
                    'order_id' => $order->id,
                ]);
            }
        }
        // Xóa các sản phẩm trong giỏ hàng
        CartItem::where('cart_id', $cartId)->delete();
        // Xóa session voucher sau khi đặt hàng thành công
        session()->forget('voucher_id');
        session()->forget('discount');
        return redirect()->route('payment.success')->with('success', 'Đặt hàng thành công!');
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
