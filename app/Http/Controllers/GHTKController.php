<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GHTKService;

class GHTKController extends Controller
{
    protected $ghtkService;

    public function __construct(GHTKService $ghtkService)
    {
        $this->ghtkService = $ghtkService;
    }

    /**
     * Tạo đơn hàng
     */
    public function createOrder(Request $request)
    {
        $orderData = $request->all(); // Lấy dữ liệu từ request
        $response = $this->ghtkService->createOrder($orderData);
        
        return response()->json($response);
    }

    /**
     * Kiểm tra trạng thái đơn hàng
     */
    public function getOrderStatus($orderId)
    {
        $response = $this->ghtkService->getOrderStatus($orderId);

        return response()->json($response);
    }

    /**
     * Tính phí vận chuyển
     */
    public function calculateShippingFee(Request $request)
    {
        $feeData = $request->all(); // Lấy dữ liệu từ request
        $response = $this->ghtkService->calculateShippingFee($feeData);

        return response()->json($response);
    }
}
