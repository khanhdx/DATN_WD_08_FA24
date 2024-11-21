<?php

namespace App\Services\Statistical;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;

class StatisticalService
{
    // Dashbroad

    // Revenue ( Doanh thu )

    // Tổng doanh thu 
    public function totalRevenue() {}

    // Theo 7 ngày gần nhất 
    public function getRevenueByLast7Days()
    {
        // Tắt only_full_group_by
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $revenues = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

        return $revenues;
    }


    // Theo tháng ( theo từng tuần )
    public function getRevenueByMonth()
    {
        $revenues = Order::selectRaw('DAY(created_at) as day, SUM(total_price) as total')
            ->whereMonth('created_at', now()->month)
            ->groupBy('day')
            ->get();

        return $revenues;
    }

    // Theo năm ( theo từng tháng )
    public function getRevenueByYear()
    {
        $revenues = Order::selectRaw('MONTH(created_at) as month, SUM(total_price) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        return $revenues;
    }


    // Orders
    public function getOrderByLast7Days()
    {
        // Tắt only_full_group_by
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

        return $orders;
    }


    // Theo tháng ( theo từng tuần )
    public function getOrderByMonth()
    {
        $orders = Order::selectRaw('DAY(created_at) as day, COUNT(*) as count')
            ->whereMonth('created_at', now()->month)
            ->groupBy('day')
            ->get();

        return $orders;
    }

    // Theo năm ( theo từng tháng )
    public function getOrderByYear()
    {
        $orders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        return $orders;
    }


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
