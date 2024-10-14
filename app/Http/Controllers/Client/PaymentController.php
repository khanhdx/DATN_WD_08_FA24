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
        }

        // Lấy dữ liệu từ giỏ hàng
        $cartItems = CartItem::where('cart_id', $cartId)->get();

        // Kiểm tra xem giỏ hàng có chứa sản phẩm không
        if ($cartItems->isEmpty()) {
        }

        // Hiển thị form thanh toán và truyền biến cartItems
        return view('client.checkouts.index', compact('cartItems'));
    }

    public function checkout(Request $request)
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
        }

        // Lấy cart từ database
        $cart = Cart::find($cartId);
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        // Lấy tất cả cart_items cho cart
        $cartItems = CartItem::where('cart_id', $cartId)->get();

        // Kiểm tra xem giỏ hàng có chứa sản phẩm không
        if ($cartItems->isEmpty()) {
        }

        // Lấy tổng giá trị từ bảng carts
        $totalPrice = $cart->total_price; // Sử dụng giá trị total_price từ cart

        // Lưu đơn hàng vào database
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'voucher_id' => $request->voucher_id, // Nếu có
            'status_order_id' => 1, // Mặc định hoặc từ yêu cầu
            'date' => now(),
            'address' => $request->address, // Địa chỉ lấy từ yêu cầu
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Lưu các chi tiết đơn hàng
        foreach ($cartItems as $item) {
            // Lấy thông tin sản phẩm biến thể từ bảng product_variants
            $productVariant = ProductVariant::find($item->product_variant_id);

            // Lấy thông tin màu sắc và kích thước từ bảng colors và sizes
            $color = Color::find($productVariant->color_id); // Thay `color_id` bằng trường tương ứng
            $size = Size::find($productVariant->size_id); // Thay `size_id` bằng trường tương ứng

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productVariant->product_id, // ID sản phẩm
                'product_variant_id' => $item->product_variant_id,
                'name_product' => $productVariant->product->name, // Tên sản phẩm
                'color' => $color ? $color->name : null, // Lấy tên màu
                'size' => $size ? $size->name : null, // Lấy tên kích thước
                'unit_price' => $productVariant->price, // Giá biến thể
                'quantity' => $item->quantity,
                'total_price' => $item->quantity * $productVariant->price, // Tính tổng giá
            ]);
        }

        // Xóa giỏ hàng sau khi thanh toán
        CartItem::where('cart_id', $cartId)->delete();

        // Tạo thông tin thanh toán
        Payment::create([
            'order_id' => $order->id,
           'user_id' => auth()->id(), // Đảm bảo truyền user_id
            'amount' => $totalPrice, // Sử dụng tổng giá trị của đơn hàng
            'transaction_type' => 0, // Có thể thay đổi loại nếu cần
            'payment_method' => $request->payment_method, // 'COD' hoặc 'VNPay'
            'status' => 0, // 0: Chưa thanh toán
            'note' => null, // Thêm ghi chú nếu cần
        ]);

        return redirect()->route('payment.success')->with('success', 'Đặt hàng thành công!');
    }


    public function paymentSuccess()
    {
        return view('client.checkouts.success');
    }
}
