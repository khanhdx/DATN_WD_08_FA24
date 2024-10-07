<?php

namespace App\Services\Color;

use App\Repositories\ColorRepository;
use Illuminate\Support\Facades\Validator;

class ColorService implements IColorService
{

    protected $colorRepository;

    public function __construct(ColorRepository $colorRepository)
    {
        $this->colorRepository = $colorRepository;
    }

    public function getAll()
    {
        // Xử lý nhiệp vụ 

        $colors = $this->colorRepository->getAll();

        return $colors;
    }


    public function getOne($id_color)
    {
        $color = $this->colorRepository->getOne($id_color);

        return $color;
    }

    public function insert($data)
    {

        // Quy định lỗi
        $rules = [
            'name' => 'required|unique:colors',
            'code_color' => 'required|unique:colors',
        ];

        // Định nghĩa lỗi
        $messages = [];

        $validator = Validator::make($data, $rules, $messages);

        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Trả về thông báo lỗi dưới dạng JSON
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // HTTP status 422 Unprocessable Entity
        };

        try {
            $color = $this->colorRepository->insert($validator->validated());

            return response([
                'message' => 'Thành công',
                'data' => $color,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    public function update($id, $data)
    {

        $color = $this->colorRepository->getOne($id);

        // Kiểm tra Color có tồn tại không ? 
        if (!$color) {
            return response()->json([
                'error' => 'Màu sác không tồn tại',
            ], 404);
        }

         // Quy định lỗi
         $rules = [
            'name' => 'required|unique:colors',
            'code_color' => 'required',
        ];

        // Định nghĩa lỗi
        $messages = [];

        $validator = Validator::make($data, $rules);

        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Trả về thông báo lỗi dưới dạng JSON
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // HTTP status 422 Unprocessable Entity
        };

        try {
            $colorUpdate = $this->colorRepository->update($id, $validator->validated());

            return response([
                'message' => 'Thành công',
                'data' => $colorUpdate,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $color = $this->colorRepository->getOne($id);

        // Kiểm tra Color có tồn tại không ? 
        if (!$color) {
            return response()->json([
                'error' => 'Màu sác không tồn tại',
            ], 404);
        }

        $deleted = $this->colorRepository->delete($id);

        if ($deleted) {
            return response([
                'message' => 'Thành công',
            ], 200);
        }

        return response([
            'message' => 'Thất bại',
        ], 500);
    }
}
