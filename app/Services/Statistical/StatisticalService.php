<?php

namespace App\Services\Statistical;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\StatusOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToArray;

class StatisticalService
{
    // Dashbroad

    // Revenue ( Doanh thu )

    // Tổng doanh thu 
    public function totalRevenue($dayStart = null, $dayEnd = null)
    {
        $completedStatusId = StatusOrder::where('id', 7)->value('id');

        if ($dayStart == null && $dayEnd == null) {
            $totalRevenue = Order::whereHas('statusOrderDetails', function ($query) use ($completedStatusId) {
                $query->where('status_order_id', $completedStatusId);
            })
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->sum('total_price');
        } else {

            $totalRevenue = Order::whereHas('statusOrderDetails', function ($query) use ($completedStatusId) {
                $query->where('status_order_id', $completedStatusId);
            })->whereBetween('created_at', [$dayStart, $dayEnd])
                ->sum('total_price');
        }

        return $totalRevenue;
    }

    // Theo 7 ngày gần nhất 
    public function getRevenueByLast7Days()
    {
        // Tắt only_full_group_by
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $revenues = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->whereHas('statusOrderDetails', function ($query) {
                $query->where('status_order_id', 7);
            })->where('created_at', '>=', Carbon::now()->subMonths(3))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

        return $revenues;
    }

    public function getRevenueInAboutDays($dayStart, $dayEnd)
    {
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $revenues = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->whereBetween('created_at', [$dayStart, $dayEnd])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();
        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

        return $revenues;
    }

    //



    // Orders

    public function countOrder($dayStart = null, $dayEnd = null)
    {
        // $excludedStatusIds = [8, 9, 10, 11];

        if ($dayStart == null && $dayEnd == null) {
            // $countOrder = Order::whereHas('statusOrderDetails', function ($query) use ( $excludedStatusIds) {
            //     $query->whereNotIn('status_order_id', $excludedStatusIds); 
            // })->count();

            $countOrder = Order::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        } else {
            $countOrder = Order::whereBetween('created_at', [$dayStart, $dayEnd])->count();
        }

        return $countOrder;
    }

    public function getOrderByLast7Days()
    {
        // Tắt only_full_group_by
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();

        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

        return $orders;
    }


    public function getOrderInAboutDays($dayStart, $dayEnd)
    {
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$dayStart, $dayEnd])
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->get();
        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

        return $orders;
    }



    public function countOrderGroupByStatus($dayStart = null, $dayEnd = null)
    {

        if ($dayStart == null && $dayEnd == null) {
            $query = DB::table('status_order_details')
                ->select('name_status', 'status_order_id',  DB::raw('count(order_id) as total'))
                ->join('status_orders', 'status_order_id', '=', 'status_orders.id')
                ->join('orders', 'order_id', '=', 'orders.id')
                ->whereBetween('orders.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->orderBy('status_order_id')
                ->groupBy('status_order_id')
                ->get();
        } else {
            $query = DB::table('status_order_details')
                ->select('name_status', 'status_order_id',  DB::raw('count(order_id) as total'))
                ->join('status_orders', 'status_order_id', '=', 'status_orders.id')
                ->join('orders', 'order_id', '=', 'orders.id')
                ->whereBetween('created_at', [$dayStart, $dayEnd])
                ->orderBy('status_order_id')
                ->groupBy('status_order_id')
                ->get();
        }


        return $query;
    }


    public function totalOrder()
    {
        return Order::count('id');
    }


    // Products
    public function countProductSold($dayStart = null, $dayEnd = null)
    {
        // $completedStatusId = StatusOrder::where('id', 1)->value('id');

        if ($dayStart == null && $dayEnd == null) {
            // $totalSoldQuantity = Order::whereHas('statusOrderDetails', function ($query) use ($completedStatusId) {
            //     $query->where('status_order_id', $completedStatusId);
            // })
            //     ->withSum('order_details', 'quantity')
            //     ->get()
            //     ->sum('order_details_sum_quantity');

            $totalSoldQuantity = Order::withSum('order_details', 'quantity')
                ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
                ->get()
                ->sum('order_details_sum_quantity');
        } else {
            $totalSoldQuantity = Order::whereBetween('created_at', [$dayStart, $dayEnd])
                ->withSum('orderDetails', 'quantity')
                ->get()
                ->sum('order_details_sum_quantity');
        }

        return $totalSoldQuantity;
    }

    public function getMaxPrice()
    {
        return Product::max('price_regular');
    }

    public function getTop10MostOrderdProucts()
    {
        $query = DB::table('order_details as od')
            ->select('pro.name as productName', DB::raw('SUM(od.quantity) as total_quantity'))
            ->join('products as pro', 'pro.id', '=', 'od.product_id')
            ->whereBetween('od.created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->groupBy('od.product_id', 'pro.name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        return $query;
    }

    // Tồn kho sản phẩm
    public function getInventoryData()
    {
        $products = Product::select('id', 'name', 'base_stock')
            ->paginate(10);

        return $products;
    }
    // User
    public function countCustomer()
    {
        $countCustomer = User::where('role', "Khách hàng")->count();

        return $countCustomer;
    }
}
