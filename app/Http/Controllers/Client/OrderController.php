<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\StatusOrder;
use App\Models\Voucher;
use App\Models\vouchersWare;
use App\Models\waresList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $reason = $request->reason;
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

            foreach ($order->orderDetails as $detail) {
                $productVariantId = $detail->product_variant_id;
                $productId = $detail->product_id;
                ProductVariant::where('id', $productVariantId)->increment('stock', $detail->quantity);
                Product::where('id', $productId)->increment('base_stock', $detail->quantity);

            }
            // Hủy dùng voucher
            if($order->voucher_id && Auth::check()) {
                $voucher_wave = vouchersWare::query()->where('user_id', '=', Auth::user()->id)->first();//Mã kho
                $wavein = waresList::query()->where('vouchers_ware_id', '=', $voucher_wave->id)->where('voucher_id','=',$order->voucher_id)->first();
                $voucher = Voucher::query()->where('id', '=', $order->voucher_id)->first();//Voucher trên hệ thống
                // Cập nhật trạng thái
                $wavein->status = "Chưa sử dụng";
                $wavein->save();
                // Cập nhật số lượng
                $voucher->remaini = $voucher->remaini + 1;
                $voucher->save();
            }
        }

        if ($order->statusOrder->contains('name_status', 'processing')) {
            $order->statusOrder()->sync([
                StatusOrder::where('name_status', 'canceling')->first()->id => [
                    'name' => $reason,
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
