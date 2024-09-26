<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductService implements IProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        $products = $this->productRepository->getAll();

        return response()->json(['data' => $products], 200);
    }

    public function getOneBy($id)
    {
        $product = $this->productRepository->getOneById($id);

        return $product;
    }

    public function insert($data)
    {

        // Quy định lỗi
        $rules = [
            'category_id' => 'required|exists:categories,id', // Kiểm tra tồn tại trong bảng categories
            'name' => 'required|unique:products,name',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'required|numeric|min:0|lt:price_regular',
            'material' => 'required|string',
            'short_desc' => 'required|string|max:255',
            'content' => 'required|string',
        ];

        // Định nghĩa lỗi

        $messages = [
            'category_id.required' => 'Danh mục không được để trống.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'avatar.required' => 'avatar không được để trống.',
            'avatar.image' => 'avatar không đúng định dạng ảnh',
            'avatar.mimes' => 'avatar phải là kiểu file jpeg,png,jpg,gif',
            'avatar.max' => 'avatar không vượt quá 5MB',
            'price_regular.required' => 'price_regular không được để trống.',
            'price_regular.numeric' => 'price_regular phải là số.',
            'price_regular.min' => 'price_regular không được âm.',
            'price_sale.required' => 'price_sale không được để trống.',
            'price_sale.numeric' => 'price_sale phải là số.',
            'price_sale.min' => 'price_sale không được âm.',
            'price_sale.lt' => 'price_sale phải nhỏ hơn price_regular.',
            'material.required' => 'material không được để trống.',
            'short_desc.required' => 'short_desc không được để trống.',
            'short_desc.max' => 'short_desc không được vượt quá 255 ký tự.',
            'content.required' => 'content không được để trống.',
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

            $import_date = Carbon::createFromFormat('d-m-Y H:i:s', now()->format('d-m-Y H:i:s'));;

            $productInput = $validator->validated();
            $productInput['import_date'] = $import_date;
            // dd($productInput);

            //Insert lên DB
            $product = $this->productRepository->insert($productInput);

            // Upload Avatar 
            // if (!empty($productInput['avatar'])) {
            //     $productInput['avatar'] = Storage::put('products', $productInput['avatar']);
            // }

            return response([
                'message' => 'Thành công',
                'data' => $product,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()], 500);
        }
    }

    public function update($id, $data) {}

    public function delete($data) {}
}
