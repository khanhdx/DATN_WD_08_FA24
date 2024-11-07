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
        $type = $request->query('type');

        switch ($type) {
            case 'day':
                $data = $this->statisticalService->getRevenueByLast7Days();
                break;
            case 'month':
                $data = $this->statisticalService->getRevenueByMonth();
                break;
            default:
                $data = $this->statisticalService->getRevenueByYear();
        }

        // dd($data);

        return response()->json($data);
    }

    public function getOrderData(Request $request)
    {
        $type = $request->query('type');

        switch ($type) {
            case 'year':
                $data = $this->statisticalService->getOrderByYear();
                break;
            case 'month':
                $data = $this->statisticalService->getOrderByMonth();
                break;
            default:
                $data = $this->statisticalService->getOrderByLast7Days();
        }

        // dd($data);

        return response()->json($data);
    }



    public function showOrderStatusChart()
    {
        $orderStatusData = $this->statisticalService->countOrderGroupByStatus();

        return response()->json($orderStatusData);
    }
}
