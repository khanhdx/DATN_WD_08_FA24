<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Repositories\SizeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    protected $size;

    public function __construct(SizeRepository $size)
    {
        $this->size = $size;
    }

    public function index()
    {
        $sizes = $this->size->getAll();

        return response()->json(['data' => $sizes], 200);
    }



    // public function show($id)
    // {
    //     $size = $this->size->getOne($id);

    //     return response()->json(['data' => $size], 200);
    // }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:sizes',
        ];

        // Định nghĩa lỗi
        $messages = [];

        $validator = Validator::make($request->all(), $rules);

        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Trả về thông báo lỗi dưới dạng JSON
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // HTTP status 422 Unprocessable Entity
        }


        try {
            $size = $this->size->insert($validator->validated());

            return response([
                'message' => 'Thành công',
                'data' => $size,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }


    public function update($id_size, Request $request)
    {
        $size = $this->size->getOne($id_size);

        // Kiểm tra size có tồn tại không ? 
        if ($size->isEmpty()) {
            return response()->json([
                'error' => 'Size không tồn tại',
            ], 404);
        }

        // Quy tắc validate
        $rules = [
            'name' => 'required|unique:sizes',
        ];

        // Định nghĩa lỗi
        $messages = [];

        $validator = Validator::make($request->all(), $rules);

        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Trả về thông báo lỗi dưới dạng JSON
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // HTTP status 422 Unprocessable Entity
        }

        $sizeUpdate = $this->size->update($id_size, $validator->validated());

        return response([
            'message' => 'Thành công',
            'data' => $sizeUpdate,
        ], 200);
    }



    public function delete($id_size)
    {
        $size = $this->size->getOne($id_size);
        // dd($size);

        // Kiểm tra size có tồn tại không ? 
        if ($size->isEmpty()) {
            return response()->json([
                'error' => 'Size không tồn tại',
            ], 404);
        }

        $deleted = $this->size->delete($id_size);

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
