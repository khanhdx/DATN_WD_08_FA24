<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GHNService
{
    // Nội dung của class ở đây
    protected $baseUrl;
    protected $apiId;
    protected $apiToken;

    public function __construct()
    {
        $this->baseUrl = config('ghn.base_url');
        $this->apiId = config('ghn.api_id');
        $this->apiToken = config('ghn.api_token');
    }

    private function sendRequest($endpoint, $data = [])
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Token' => $this->apiToken,
            'ShopId' => $this->apiId
        ])->post($this->baseUrl . $endpoint, $data);

        return $response->json();
    }

    public function getProvinces()
    {
        return $this->sendRequest('/master-data/province');
    }

    public function getDistricts($provinceId)
    {
        return $this->sendRequest('/master-data/district', ['province_id' => $provinceId]);
    }

    public function getWards($districtId)
    {
        return $this->sendRequest('/master-data/ward', ['district_id' => $districtId]);
    }

    public function calculateShippingFee($data)
    {
        return $this->sendRequest('/v2/shipping-order/fee', $data);
    }

    public function createOrder($data)
    {
        return $this->sendRequest('/v2/shipping-order/create', $data);
    }
}