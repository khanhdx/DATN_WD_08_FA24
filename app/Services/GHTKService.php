<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class GHTKService
{
    protected $baseUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->baseUrl = config('ghtk.base_url');
        $this->apiToken = config('ghtk.api_token');
    }

    /**
     * Tạo đơn hàng GHTK
     */
    public function createOrder(array $orderData)
    {
        $url = $this->baseUrl . '/services/shipment/order';
        $response = Http::withToken($this->apiToken)->post($url, $orderData);

        // Xử lý phản hồi
        if ($response->successful()) {
            return $response->json(); // Trả về dữ liệu JSON nếu thành công
        }

        return [
            'success' => false,
            'message' => $response->json()['message'] ?? 'Lỗi không xác định',
        ];
    }
}
