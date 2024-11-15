<?php

namespace App\Http\Controllers;

use App\Services\GHNService;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    protected $ghnService;

    public function __construct(GhnService $ghnService)
    {
        $this->ghnService = $ghnService;
    }

    // Lấy danh sách tỉnh/thành
    public function getProvinces()
    {
        $provinces = $this->ghnService->getProvinces();
        return response()->json($provinces);
    }

    // Lấy danh sách quận/huyện
    public function getDistricts(Request $request)
    {
        $districts = $this->ghnService->getDistricts($request->province_id);
        return response()->json($districts);
    }

    // Tạo đơn hàng mới
    public function createOrder(Request $request)
    {
        $data = [
            "from_name" => "khanhdx",
            "from_phone" => "0333464071",
            "from_address" => "hà nội",
            "from_ward_code" => "156750",
            "from_district_id" => 1493, // ID quận/huyện người gửi
            "to_name" => $request->input('to_name'),
            "to_phone" => $request->input('to_phone'),
            "to_address" => $request->input('to_address'),
            "to_ward_code" => $request->input('to_ward_code'),
            "to_district_id" => $request->input('to_district_id'),
            "cod_amount" => $request->input('cod_amount'),
            "weight" => $request->input('weight'),
            "length" => $request->input('length'),
            "width" => $request->input('width'),
            "height" => $request->input('height'),
            "required_note" => "KHONGCHOXEMHANG", // Hoặc ghi chú về đơn hàng nếu cần
            "items" => [
                [
                    "name" => "test",  // Tên sản phẩm
                    "quantity" => 10,  // Số lượng
                    "category" => (object)[],   // Danh mục (có thể để trống hoặc cung cấp thông tin cụ thể)
                    "weight" => 2  // Trọng lượng của sản phẩm
                ]
                ],
            "payment_type_id" => 2
        ];

        $order = $this->ghnService->createOrder($data);
        return response()->json($order);
    }
}
