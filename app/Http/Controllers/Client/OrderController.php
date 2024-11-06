<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\StatusOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng của người dùng hiện tại
        $orders = Order::with('statusOrder')->where('user_id', auth()->id())->get();

        // Trả về view danh sách đơn hàng
        return view('client.checkouts.orders', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with(['order_details.variant', 'payments', 'statusOrder', 'voucherWare.voucher'])->find($id);

        // Kiểm tra nếu đơn hàng không tồn tại
        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Đơn hàng không tồn tại.');
        }
        return view('client.checkouts.showOrder', compact('order')); // Truyền cả order và status
    }

    public function update(Request $request, $id)
    {
        // Lấy đơn hàng theo ID
        $order = Order::findOrFail($id);
        // Kiểm tra xem đơn hàng có trạng thái 'pending' không
        if ($order->statusOrder->contains('name_status', 'pending')) {
            // Thay đổi trạng thái đơn hàng thành 'canceled'
            $order->statusOrder()->sync([
                StatusOrder::where('name_status', 'canceled')->first()->id => [
                    'name' => 'canceled',
                    'updated_at' => now(),
                ]
            ]);
        } 
        return redirect()->route('orders.index');
    }
    
}
