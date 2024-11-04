<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GhnService
{
    protected $client;
    protected $apiId;
    protected $apiToken;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://online-gateway.ghn.vn/shiip/public-api/',
            'timeout'  => 10.0,
        ]);
        $this->apiId = env('GHN_API_ID');
        $this->apiToken = env('GHN_API_TOKEN');
    }

    // Phương thức lấy danh sách tỉnh/thành phố
    public function getProvinces()
    {
        try {
            $response = $this->client->request('GET', 'master-data/province', [
                'headers' => [
                    'Token' => $this->apiToken,
                ]
            ]);

            if ($response->getStatusCode() !== 200) {
                Log::error("GHN Error: Unexpected status code " . $response->getStatusCode());
                return null; // Hoặc trả về thông báo lỗi cụ thể
            }

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("GHN Error: " . $e->getMessage());
            return null;
        }
    }

    // Phương thức lấy danh sách quận/huyện từ tỉnh/thành phố
    public function getDistricts($provinceId)
    {
        try {
            $response = $this->client->request('GET', 'master-data/district', [
                'headers' => [
                    'Token' => $this->apiToken,
                ],
                'query' => [
                    'province_id' => $provinceId,
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("GHN Error: " . $e->getMessage());
            return null;
        }
    }

    // Phương thức tính phí vận chuyển
    public function calculateShippingFee($data)
    {
        try {
            $response = $this->client->request('POST', 'v2/shipping-order/fee', [
                'headers' => [
                    'Token' => $this->apiToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data
            ]);

            if ($response->getStatusCode() !== 200) {
                Log::error("GHN Error: Unexpected status code " . $response->getStatusCode());
                return null; // Hoặc trả về thông báo lỗi cụ thể
            }

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("GHN Error: " . $e->getMessage());
            return null;
        }
    }

    // Phương thức tạo đơn hàng
    public function createOrder($data)
    {
        try {
            $response = $this->client->request('POST', 'v2/shipping-order/create', [
                'headers' => [
                    'Token' => $this->apiToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $data
            ]);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            Log::error("GHN Error: " . $e->getMessage());
            return null;
        }
    }
}