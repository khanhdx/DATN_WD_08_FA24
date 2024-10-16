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
        $cartItems = CartItem::where('cart_id', $cartId)->get();

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
    
        // Lấy cart từ database
        $cart = Cart::find($cartId);
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }
    
        // Lấy tất cả cart_items cho cart
        $cartItems = CartItem::where('cart_id', $cartId)->get();
    
        // Kiểm tra xem giỏ hàng có chứa sản phẩm không
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }
    
        // Lấy tổng giá trị từ bảng carts
        $totalPrice = 0; // Khởi tạo biến tổng giá
    
        // Lưu đơn hàng vào database
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $totalPrice,
            'voucher_id' => $request->voucher_id, // Nếu có
            'status_order_id' => 1, // Mặc định trạng thái là "processing"
            'date' => now(),
            'address' => $request->address, // Địa chỉ lấy từ yêu cầu
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Lưu các chi tiết đơn hàng
        foreach ($cartItems as $item) {
            // Lấy thông tin sản phẩm biến thể từ bảng product_variants
            $productVariant = ProductVariant::find($item->product_variant_id);
    
            // Tính tổng giá cho từng chi tiết đơn hàng
            $detailTotalPrice = $item->quantity * $productVariant->price;
    
            // Cộng dồn tổng giá trị của đơn hàng
            $totalPrice += $detailTotalPrice;

            // Tạo chi tiết đơn hàng
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productVariant->product_id,
                'product_variant_id' => $item->product_variant_id,
                'name_product' => $productVariant->product->name,
                'color' => $productVariant->color->name ?? null, // Lấy tên màu
                'size' => $productVariant->size->name ?? null, // Lấy tên kích thước
                'unit_price' => $productVariant->price,
                'quantity' => $item->quantity,
                'total_price' => $detailTotalPrice,
            ]);
        }
    
        // Lưu tổng giá vào bảng orders
        $order->total_price = $totalPrice; // Gán tổng giá cho đơn hàng
        $order->save(); // Lưu lại thay đổi

        // Tạo bản ghi trạng thái đơn hàng
        StatusOrderDetail::create([
            'status_order_id' => 1, // ID trạng thái "processing"
            'order_id' => $order->id,
            'name' => 'Đơn hàng mới', 
        ]);
    
        // Xóa giỏ hàng sau khi thanh toán
        CartItem::where('cart_id', $cartId)->delete();
    
        // Tạo thông tin thanh toán
        Payment::create([
            'order_id' => $order->id,
            'user_id' => auth()->id(),
            'amount' => $totalPrice,
            'transaction_type' => 0,
            'payment_method' => $request->payment_method,
            'status' => 0,
            'note' => null,
        ]);
    
        // Cập nhật trạng thái đơn hàng
        $order->status_order_id = 1; // Cập nhật trạng thái là "processing"
        $order->save();
    
        return redirect()->route('payment.success')->with('success', 'Đặt hàng thành công!');
    }

    public function paymentSuccess()
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (auth()->check()) {
            // Nếu đã đăng nhập, lấy đơn hàng từ database
            $orders = Order::where('user_id', auth()->id())->get();
            
            if ($orders->isEmpty()) {
                // Nếu không có đơn hàng, redirect về trang khác
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }

            $statusOrder = $orders->last(); // Lấy đơn hàng mới nhất

            return view('client.checkouts.success', compact('statusOrder'));
        } else {
            // Nếu chưa đăng nhập, lấy đơn hàng từ session
            if (!session()->has('order')) {
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }

            $statusOrder = session('order');

            return view('client.checkouts.payment_success', compact('statusOrder'));
        }
    }
}
