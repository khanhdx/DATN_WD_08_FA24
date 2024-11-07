<?php

namespace App\Http\Controllers;

use App\Services\GhnService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $ghnService;

    public function __construct(GhnService $ghnService)
    {
        $this->ghnService = $ghnService;
    }

    public function getProvinces()
    {
        $provinces = $this->ghnService->getProvinces();
        if ($provinces === null) {
            return response()->json(['error' => 'Could not retrieve provinces.'], 500);
        }
        return response()->json($provinces);
    }

    public function getDistricts(Request $request)
    {
        $request->validate([
            'province_id' => 'required|integer',
        ]);

        $provinceId = $request->input('province_id');
        $districts = $this->ghnService->getDistricts($provinceId);
        if ($districts === null) {
            return response()->json(['error' => 'Could not retrieve districts.'], 500);
        }
        return response()->json($districts);
    }

    public function calculateShippingFee(Request $request)
    {
        $request->validate([
            'to_district_id' => 'required|integer',
            'weight' => 'required|numeric',
        ]);

        $feeData = $request->all();
        $fee = $this->ghnService->calculateShippingFee($feeData);
        if ($fee === null) {
            return response()->json(['error' => 'Could not calculate shipping fee.'], 500);
        }
        return response()->json($fee);
    }

    public function createOrder(Request $request)
    {
        $request->validate([
            'order_details' => 'required|array',
            'to_district_id' => 'required|integer',
        ]);

        $orderData = $request->all();
        $order = $this->ghnService->createOrder($orderData);
        if ($order === null) {
            return response()->json(['error' => 'Could not create order.'], 500);
        }
        return response()->json($order);
    }
}
