<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                $query->where('status_order_id', 1)->where('name','MOMO'); // Trạng thái "Chờ thanh toán"
            })
            ->latest()
            ->first();

        if ($order) {
            // Xóa các bản ghi liên quan
            $order->orderDetails()->delete(); // Xóa order_details
            $order->statusOrderDetails()->delete(); // Xóa status_order_details
            $order->delete(); // Xóa order
        }

        return $next($request);
    }
}
