<?php

namespace App\Http\Controllers;

use App\Services\GHNService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $ghnService;

    public function __construct(GHNService $ghnService)
    {
        $this->ghnService = $ghnService;
    }

    public function calculateShippingFee(Request $request)
    {
        $data = [
            'from_district_id' => $request->from_district_id,
            'service_id' => $request->service_id,
            'to_district_id' => $request->to_district_id,
            'to_ward_code' => $request->to_ward_code,
            'weight' => $request->weight,
            'insurance_value' => $request->insurance_value,
        ];

        $fee = $this->ghnService->calculateShippingFee($data);
        return response()->json($fee);
    }

    public function createOrder(Request $request)
    {
        $data = [
            'from_name' => $request->from_name,
            'from_phone' => $request->from_phone,
            'from_address' => $request->from_address,
            'to_name' => $request->to_name,
            'to_phone' => $request->to_phone,
            'to_address' => $request->to_address,
            'weight' => $request->weight,
            'insurance_value' => $request->insurance_value,
            // Các thông tin khác cần thiết
        ];

        $order = $this->ghnService->createOrder($data);
        return response()->json($order);
    }
}