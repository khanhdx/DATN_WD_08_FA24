<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Statistical\StatisticalService;
use Illuminate\Http\Request;

class StatisticalController extends Controller
{
    protected $statisticalService;

    public function __construct(StatisticalService $statisticalService)
    {
        $this->statisticalService = $statisticalService;
    }

    public function getRevenueData(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($startDate && $endDate) {
            $revenues = $this->statisticalService->getRevenueInAboutDays($startDate, $endDate);
        } else {
            $revenues = $this->statisticalService->getRevenueByLast7Days();
        }

        return response()->json($revenues);
    }

    public function getOrderData(Request $request)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        if ($startDate && $endDate) {
            $orders = $this->statisticalService->getOrderInAboutDays($startDate, $endDate);
        } else {
            $orders = $this->statisticalService->getOrderByLast7Days();
        }

        return response()->json($orders);
    }

    public function showOrderStatusChart()
    {
        $orderStatusData = $this->statisticalService->countOrderGroupByStatus();

        return response()->json($orderStatusData);
    }

    public function getTop10MostOrderdProucts()
    {
        $products = $this->statisticalService->getTop10MostOrderdProucts();

        return response()->json($products);
    }

    public function getInventoryData()
    {
        $inventories = $this->statisticalService->getInventoryData();
        return response()->json($inventories);
    }
}
