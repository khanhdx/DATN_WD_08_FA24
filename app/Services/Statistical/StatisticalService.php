<?php

namespace App\Services\Statistical;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StatisticalService
{
    // Dashbroad
    public function getRevenueByDay()
    {
        $revenues = Order::selectRaw('HOUR(created_at) as hour, SUM(total_price)')
            ->whereDate('created_at', today())
            ->groupBy('hour')
            ->get();
        return $revenues;
    }

    public function getRevenue() {}


    // Orders
    public function countOrderGroupByStatus()
    {
        $query = DB::table('status_order_details')
            ->select('name_status', 'status_order_id',  DB::raw('count(order_id) as total'))
            ->join('status_orders', 'status_order_id', '=', 'status_orders.id')
            ->orderBy('status_order_id')
            ->groupBy('status_order_id')
            ->get();

        return $query;
    }

    public function totalOrder()
    {
        return Order::count('id');
    }


    // Products
    public function getMaxPrice()
    {
        return Product::max('price_regular');
    }
}
