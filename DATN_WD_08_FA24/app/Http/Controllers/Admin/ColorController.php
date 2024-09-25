<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Repositories\ColorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{

    protected $color;

    public function __construct(ColorRepository $color)
    {
        $this->color = $color;
    }

    public function index()
    {
        $colors = $this->color->getAll();

        return response()->json(['data' => $colors], 200);
    }



    // public function show($id)
    // {
    //     $color = $this->color->getOne($id);

    //     return response()->json(['data' => $color], 200);
    // }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:colors',
            'code_color' => 'required|unique:colors',
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
            $color = $this->color->insert($validator->validated());

            return response([
                'message' => 'Thành công',
                'data' => $color,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }


    public function update($id_color, Request $request)
    {
        $color = $this->color->getOne($id_color);

        // Kiểm tra Color có tồn tại không ? 
        if ($color->isEmpty()) {
            return response()->json([
                'error' => 'Màu sác không tồn tại',
            ], 404);
        }

        // Quy tắc validate
        $rules = [
            'name' => 'required|unique:colors',
            'code_color' => 'required|unique:colors',
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

        $colorUpdate = $this->color->update($id_color, $validator->validated());

        return response([
            'message' => 'Thành công',
            'data' => $colorUpdate,
        ], 200);
    }



    public function delete($id_color)
    {
        $color = $this->color->getOne($id_color);
        // dd($color);

        // Kiểm tra Color có tồn tại không ? 
        if ($color->isEmpty()) {
            return response()->json([
                'error' => 'Màu sác không tồn tại',
            ], 404);
        }

        $deleted = $this->color->delete($id_color);

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
