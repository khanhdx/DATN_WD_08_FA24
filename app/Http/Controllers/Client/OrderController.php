<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        // Lấy danh sách đơn hàng của người dùng hiện tại
        $orders = Order::with('statusOrder')->where('user_id', auth()->id())->get();

        // Trả về view danh sách đơn hàng
        return view('client.checkouts.orders', compact('orders'));
    }


    // Trong controller của bạn
    public function show($id)
    {
        $order = Order::with(['order_details.variant', 'payments', 'statusOrder'])->find($id);

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }

        // Lấy trạng thái đầu tiên (nếu có) từ mối quan hệ statusOrder
        $status = $order->statusOrder->first(); // Lấy trạng thái đầu tiên

        return view('client.checkouts.showOrder', compact('order', 'status')); // Truyền cả order và status
    }
}
