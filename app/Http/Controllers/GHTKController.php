<?php

namespace App\Http\Controllers;

// use App\Services\GHTKService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GHTKController extends Controller
{
    // protected $ghtkService;

    // public function __construct(GHTKService $ghtkService)
    // {
    //     $this->ghtkService = $ghtkService;
    // }

    public function createOrder(Request $request)
    {

        // Gửi yêu cầu tới GHTK API
        try {
            $response = Http::withHeaders([
                'Token' => env('GHTK_TOKEN'), // Token lấy từ file .env
            ])->post('https://services.ghtk.vn/services/shipment/order', [
                'pick_address' => $request->pick_address,
                'pick_province' => $request->pick_province,
                'pick_district' => $request->pick_district,
                'address' => $request->address,
                'province' => $request->province,
                'district' => $request->district,
                'weight' => $request->weight,
                'value' => $request->value,
            ]);

            // Kiểm tra phản hồi từ GHTK
            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['success']) && $data['success']) {
                    // Đơn hàng tạo thành công
                    return response()->json([
                        'success' => true,
                        'order' => $data['order'], // Thông tin đơn hàng
                    ], 200);
                } else {
                    // GHTK trả về lỗi
                    return response()->json([
                        'success' => false,
                        'message' => $data['message'] ?? 'Không thể tạo đơn hàng',
                    ], 400);
                }
            }

            // Trường hợp phản hồi không thành công
            return response()->json([
                'success' => false,
                'message' => 'Lỗi kết nối tới GHTK hoặc dữ liệu không hợp lệ',
            ], 400);
        } catch (\Exception $e) {
            // Xử lý lỗi không mong muốn
            return response()->json([
                'success' => false,
                'message' => 'Lỗi không mong muốn xảy ra',
                'error' => $e->getMessage(),
            ], 500);
        }

        // $validated = $request->validate([
        //     'pick_address' => 'required|string',
        //     'pick_province' => 'required|string',
        //     'pick_district' => 'required|string',
        //     'address' => 'required|string',
        //     'province' => 'required|string',
        //     'district' => 'required|string',
        //     'weight' => 'required|integer',
        //     'value' => 'required|numeric',
        // ]);

        // $orderData = [
        //     'pick_address' => $validated['pick_address'],
        //     'pick_province' => $validated['pick_province'],
        //     'pick_district' => $validated['pick_district'],
        //     'address' => $validated['address'],
        //     'province' => $validated['province'],
        //     'district' => $validated['district'],
        //     'weight' => $validated['weight'],
        //     'value' => $validated['value'],
        //     'transport' => 'road', // Loại hình vận chuyển
        // ];

        // $result = $this->ghtkService->createOrder($orderData);

        // if ($result['success'] ?? false) {
        //     return response()->json([
        //         'message' => 'Tạo đơn hàng thành công!',
        //         'data' => $result['order'] ?? [],
        //     ]);
        // }

        // return response()->json([
        //     'message' => 'Tạo đơn hàng thất bại!',
        //     'error' => $result['message'] ?? 'Không xác định',
        // ], 400);
    }
}
