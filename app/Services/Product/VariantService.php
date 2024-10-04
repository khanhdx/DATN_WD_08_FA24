<?php

namespace App\Services\Product;


use App\Models\ProductVariant;
use App\Repositories\VariantRepositopy;
use Illuminate\Support\Facades\Validator;

class VariantService implements IVariantService {
    protected $variant;

    public function __construct(VariantRepositopy $variantRepositopy, )
    {
        $this->variant = $variantRepositopy;
    }

    public function getAll()
    {
        $variants = $this->variant->getAll();

        // dd($variants);

        return $variants;
    }

    public function getOneById($id)
    {
        $variant = $this->variant->getOneById($id);

        return $variant;
    }

    public function insert($data)
    {


        // Quy định lỗi
        $rules = [
            'product_id' => 'required|exists:products,id', // Kiểm tra tồn tại trong bảng products
            'color_id' => 'required|exists:colors,id', // Kiểm tra tồn tại trong bảng colors
            'size_id' => 'required|exists:sizes,id', // Kiểm tra tồn tại trong bảng szies
            
            'stock' => 'required|numeric|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];

        // Định nghĩa lỗi

        $messages = [
            'product_id.required' => 'Sản phẩm không được bỏ trống.',
            'product_id.exists' => 'Sản phẩm này không tồn tại.',

            'color_id.required' => 'Màu sắc không được bỏ trống.',
            'color_id.exists' => 'Màu sắc không tồn tại.',

            'size_id.required' => 'Kích thước không được bỏ trống.',
            'size_id.exists' => 'Kích thước không tồn tại.',

            
            'stock.required' => 'Số lượng tồn kho không được bỏ trống.',
            'stock.numeric' => 'Số lượng tồn kho phải là một số.',
            'stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'stock.min' => 'Số lượng tồn kho phải là số không âm.',

            'price.required' => 'Giá không được bỏ trống.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Trả về thông báo lỗi dưới dạng JSON
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // HTTP status 422 Unprocessable Entity
        }


        try {

            
            $variantInput = $validator->validated();
            $images[] = $variantInput['images'];
            //Kiểm tra sp biến nào có trùng không ?

            //Insert lên DB
            $variant = $this->variant->insert($variantInput);

            foreach($images as $index => $image){
               dd($image);
            }
            
          
            return response([
                'message' => 'Thành công',
                'data' => $variant,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    public function update($data, $id)
    {
        // Kiểm tra product variant có tồn tạo không ?
        $variant = $this->variant->getOneById($id);

        if(!$variant){
            return response([
                'error' => 'Sản phẩm không tồn tại',
            ], 404);
        }

        // Quy định lỗi
        $rules = [
            'color_id' => 'required|exists:colors,id', // Kiểm tra tồn tại trong bảng colors
            'size_id' => 'required|exists:sizes,id', // Kiểm tra tồn tại trong bảng szies
            'stock' => 'required|numeric|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];

        // Định nghĩa lỗi

        $messages = [
            'color_id.required' => 'Màu sắc không được bỏ trống.',
            'color_id.exists' => 'Màu sắc không tồn tại.',

            'size_id.required' => 'Kích thước không được bỏ trống.',
            'size_id.exists' => 'Kích thước không tồn tại.',

            'stock.required' => 'Số lượng tồn kho không được bỏ trống.',
            'stock.numeric' => 'Số lượng tồn kho phải là một số.',
            'stock.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'stock.min' => 'Số lượng tồn kho phải là số không âm.',

            'price.required' => 'Giá không được bỏ trống.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá phải lớn hơn hoặc bằng 0.',
        ];

        $validator = Validator::make($data, $rules, $messages);


        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Trả về thông báo lỗi dưới dạng JSON
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // HTTP status 422 Unprocessable Entity
        }

        try {
            
            //update lên DB
            $variantInput = $validator->validated();
            // dd($productInput);

            $variant = $this->variant->updateById($variantInput, $id);

            return response([
                'message' => 'Thành công',
                'data' => $variant,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    public function delete($data) {
        
    }

    
}