<?php

namespace App\Services\Statistical;

use App\Models\Order;
use App\Models\OrderDetail;
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

    public function getRevenueInAboutDays($dayStart, $dayEnd)
    {
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $revenues = Order::selectRaw('DATE(created_at) as date, SUM(total_price) as total')
            ->whereBetween('created_at', [$dayStart, $dayEnd])
            ->groupBy('date')
            ->get();
        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

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


    public function getOrderInAboutDays($dayStart, $dayEnd)
    {
        DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $orders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereBetween('created_at', [$dayStart, $dayEnd])
            ->groupBy('date')
            ->get();
        // Bật only_full_group_by
        DB::statement("SET SESSION sql_mode=CONCAT(@@sql_mode, ',ONLY_FULL_GROUP_BY')");

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

    public function getTop10MostOrderdProucts()
    {
        $query = DB::table('order_details as od')
            ->select('pro.name as productName', DB::raw('SUM(od.quantity) as total_quantity'))
            ->join('products as pro', 'pro.id', '=', 'od.product_id')
            ->groupBy('od.product_id', 'pro.name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        return $query;
    }

    // Tồn kho sản phẩm
    public function getInventoryData()
    {
        $products = Product::with(['variants.color', 'variants.size'])
            ->select('id', 'name', 'base_stock')
            ->get()
            ->map(function ($product) {
                $variantData = $product->variants->map(function ($variant) {
                    return [
                        'variant_id' => $variant->id,
                        'color' => $variant->color->name ?? 'No Color',
                        'code_color' => $variant->color->code_color ?? 'No Color',
                        'size' => $variant->size->name ?? 'No Size',
                        'quantity' => $variant->stock,
                    ];
                });

                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'base_stock' => $product->base_stock,
                    'variants' => $variantData,
                ];
            });

        return $products;
    }
}
