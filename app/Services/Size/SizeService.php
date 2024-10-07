<?php

namespace App\Services\Size;

use App\Repositories\SizeRepository;
use Illuminate\Support\Facades\Validator;

class SizeService implements ISizeService
{

    protected $sizeRepository;

    public function __construct(SizeRepository $sizeRepository)
    {
        $this->sizeRepository = $sizeRepository;
    }

    public function getAll()
    {
        // Xử lý nhiệp vụ 

        $sizes = $this->sizeRepository->getAll();

        return  $sizes;
    }


    public function getOne($id)
    {
        $size = $this->sizeRepository->getOne($id);

        return $size;
    }

    public function insert($data)
    {

        // Quy định lỗi
        $rules = [
            'name' => 'required|unique:sizes',
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
            $size = $this->sizeRepository->insert($validator->validated());

            return response([
                'message' => 'Thành công',
                'data' => $size,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    public function update($id, $data)
    {

        $size = $this->sizeRepository->getOne($id);

        // Kiểm tra size có tồn tại không ? 
        if (!$size) {
            return response()->json([
                'error' => 'Màu sác không tồn tại',
            ], 404);
        }

         // Quy định lỗi
         $rules = [
            'name' => 'required|unique:sizes',
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
            $sizeUpdate = $this->sizeRepository->update($id, $validator->validated());

            return response([
                'message' => 'Thành công',
                'data' => $sizeUpdate,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        $size = $this->sizeRepository->getOne($id);

        // Kiểm tra size có tồn tại không ? 
        if (!$size) {
            return response()->json([
                'error' => 'Màu sác không tồn tại',
            ], 404);
        }

        $deleted = $this->sizeRepository->delete($id);

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
