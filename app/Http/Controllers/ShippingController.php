<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class ShippingController extends Controller
{
    public function calculateShipping(Request $request)
    {
        // Lấy thông tin địa chỉ từ form
        $province = $request->province;
        $district = $request->district;
        $ward_street = $request->ward_street;
        $address = $request->address;

        // Gọi API của GHTK để lấy thông tin vận chuyển
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GHTK_API_TOKEN'), // Token API GHTK
        ])->post('https://services.giaohangtietkiem.vn/services/shipment/fee', [
            'province' => $province,
            'district' => $district,
            'ward_street' => $ward_street,
            'address' => $address,
        ]);

        // Xử lý phản hồi từ API GHTK
        if ($response->successful()) {
            $shippingCost = $response->json()['shipping_cost']; // giả sử API trả về phí vận chuyển
            return view('checkouts.index', compact('shippingCost'));
        }

        // Xử lý lỗi nếu có
        return back()->withErrors(['error' => 'Không thể tính toán phí vận chuyển.']);
    }
}
