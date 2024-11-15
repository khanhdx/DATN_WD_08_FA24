<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GHNService
{
    // Nội dung của class ở đây
    protected $apiId;
    protected $apiToken;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiId = env('GHN_API_ID');
        $this->apiToken = env('GHN_API_TOKEN');
        $this->baseUrl = env('GHN_BASE_URL');
    }

    // Hàm lấy thông tin tỉnh thành
    public function getProvinces()
    {
        $response = Http::withHeaders([
            'Token' => $this->apiToken
        ])->get("{$this->baseUrl}/master-data/province");

        return $response->json();
    }

    // Hàm lấy thông tin quận/huyện theo tỉnh thành
    public function getDistricts($provinceId)
    {
        $response = Http::withHeaders([
            'Token' => $this->apiToken
        ])->get("{$this->baseUrl}/master-data/district", [
            'province_id' => $provinceId
        ]);

        return $response->json();
    }

    // Hàm tạo đơn hàng
    public function createOrder($data)
    {
        $response = Http::withHeaders([
            'Token' => $this->apiToken
        ])->post("{$this->baseUrl}/v2/shipping-order/create", $data);

        return $response->json();
    }
}