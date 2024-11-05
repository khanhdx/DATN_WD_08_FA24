<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GHTKService
{
    protected $apiToken;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiToken = config('services.ghtk.token');
        $this->baseUrl = config('services.ghtk.base_url');
    }

    /**
     * Tạo đơn hàng mới trên GHTK
     */
    public function createOrder(array $orderData)
    {
        $response = Http::withHeaders([
            'Token' => $this->apiToken,
        ])->post("{$this->baseUrl}/services/shipment/order", $orderData);

        return $this->handleResponse($response);
    }

    /**
     * Lấy trạng thái đơn hàng từ GHTK
     */
    public function getOrderStatus($orderId)
    {
        $response = Http::withHeaders([
            'Token' => $this->apiToken,
        ])->get("{$this->baseUrl}/services/shipment/v2/$orderId");

        return $this->handleResponse($response);
    }

    /**
     * Tính phí vận chuyển
     */
    public function calculateShippingFee(array $feeData)
    {
        $response = Http::withHeaders([
            'Token' => $this->apiToken,
        ])->post("{$this->baseUrl}/services/shipment/fee", $feeData);

        return $this->handleResponse($response);
    }

    /**
     * Xử lý phản hồi từ GHTK
     */
    protected function handleResponse($response)
    {
        if ($response->successful()) {
            return $response->json();
        } else {
            return [
                'error' => true,
                'message' => $response->json('message') ?? 'Không thể kết nối với GHTK',
            ];
        }
    }
}