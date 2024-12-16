<?php

namespace App\Http\Middleware;

use App\Models\Order;
use App\Models\Voucher;
use App\Models\vouchersWare;
use App\Models\waresList;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckOrderStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy đơn hàng gần nhất của người dùng có trạng thái "Chờ thanh toán"
        $order = Order::where('user_id', Auth::id())
            ->whereHas('statusOrderDetails', function ($query) {
                $query->where('status_order_id', 1)->where('name','zaloPay'); // Trạng thái "Chờ thanh toán"
            })
            ->latest()
            ->first();

        if ($order) {
            // Xóa các bản ghi liên quan
            $order->orderDetails()->delete(); // Xóa order_details
            $order->statusOrderDetails()->delete(); // Xóa status_order_details
            // Cập nhật lại trạng thái voucher trong kho sau khi sử dụng (Sử dụng mã)
            if($order->voucher_id) {
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
            $order->delete(); // Xóa order
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
            }
        }

        return $next($request);
    }
}
