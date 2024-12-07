<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\StatusOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
{
    // Lấy danh sách đơn hàng của người dùng hiện tại, bao gồm trạng thái và phương thức thanh toán
    $orders = Order::with('statusOrder', 'payments')->where('user_id', auth()->id())->get();

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
        
        if ($order->statusOrder->contains('name_status', 'pending')) {

            $response = Http::withHeaders([
                'Token' => env('TOKEN_GHN'),
                'ShopId' => env('SHOP_ID')
            ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/switch-status/cancel', [
                'order_codes' => [
                    $order->order_code
                ],
            ]);
    
            if (!$response->successful()) {
                Log::error('Cancel Order Fail: ' . $response->body());
                return redirect()->route('orders.index')->with('error', 'Có lỗi trong quá trình hủy đơn, quá khách vui lòng thử lại sau!');
            }
    
            $order->statusOrder()->sync([
                StatusOrder::where('name_status', 'canceled')->first()->id => [
                    'name' => 'canceled',
                    'updated_at' => now(),
                ]
            ]);
        }
        
        if ($order->statusOrder->contains('name_status', 'success')) {
    
            $order->statusOrder()->sync([
                StatusOrder::where('name_status', 'completed')->first()->id => [
                    'name' => 'completed',
                    'updated_at' => now(),
                ]
            ]);
        }
        if ($order->statusOrder->contains('name_status', 'success')) {
    
            $order->statusOrder()->sync([
                StatusOrder::where('name_status', 'refunding')->first()->id => [
                    'name' => 'refunding',
                    'updated_at' => now(),
                ]
            ]);
        }
        return redirect()->route('orders.index');
    }
    public function getOrderStatus($id)
    {
        $order = Order::with('statusOrder')->findOrFail($id);
        $currentStatus = $order->statusOrder->last()->status_label ?? 'Chưa có trạng thái';
    
        return response()->json([
            'status' => $currentStatus,
        ]);
    }
}
