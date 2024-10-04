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

        return $products;
    }

    public function getOneById($id)
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
            'image' => 'required|mimes:jpg,jpeg,png|max:2048',
            'SKU' => 'required|unique:products,SKU',
            'price_regular' => 'required|numeric|min:0',
            'price_sale' => 'numeric|min:0|lt:price_regular',
            'description' => 'max:255',
            'content' => 'nullable|string',
        ];

        // Định nghĩa lỗi

        $messages = [
            'category_id.required' => 'Danh mục không được để trống.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'image.required' => 'Không bỏ trống ảnh',
            'image.mimes' => 'Không đúng định dạng ảnh jpg,jpeg,png',
            'image.max' => 'Ảnh không vượt quá 2MB',
            'name.required' => 'Tên không để trống',
            'name.unique' => 'Tên đã tồn tại',
            'SKU.required' => 'Mã sản phẩm không để trống',
            'SKU.unique' => 'Mã sản phẩm đã tồn tại',
            'price_regular.required' => 'price_regular không được để trống.',
            'price_regular.numeric' => 'price_regular phải là số.',
            'price_regular.min' => 'price_regular không được âm.',
            'price_sale.numeric' => 'price_sale phải là số.',
            'price_sale.min' => 'price_sale không được âm.',
            'price_sale.lt' => 'price_sale phải nhỏ hơn price_regular.',
            'description.max' => 'short_desc không được vượt quá 255 ký tự.',
        ];

        $validator = Validator::make($data, $rules, $messages);

        // Kiểm tra xem có lỗi không
        if ($validator->fails()) {
            // Trả về thông báo lỗi dưới dạng JSON
            // Trả thông báo cho view
            return response()->json([
                'errors' => $validator->errors(),
            ], 422); // HTTP status 422 Unprocessable Entity
        }


        try {
            $productInput = $validator->validated();
            
            // Upload Image
            if($productInput['image'] instanceof \Illuminate\Http\UploadedFile) {
                $productInput['image'] = $productInput['image']->store('uploads/products', 'public');
            }else {
                $productInput['image'] = null;
            }
            // dd($productInput);

            //Insert lên DB
            $product = $this->productRepository->insert($productInput);

            return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }

    public function update($data, $id)
    {
        // Kiểm tra product có tồn tạo không ?
        $product = $this->productRepository->getOneById($id);

        if(!$product){
            return response([
                'error' => 'Sản phẩm không tồn tại',
            ], 404);
        }
        
        // Quy định lỗi
        $rules = [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'SKU' => 'required|unique:products,SKU',
            'description' => 'string|max:255',
            'content' => 'nullable|string',
        ];

        // Định nghĩa lỗi

        $messages = [
            'category_id.required' => 'Danh mục không được để trống.',
            'category_id.exists' => 'Danh mục không tồn tại.',
            'SKU.required' => 'Mã sản phẩm không để trống',
            'SKU.unique' => 'Mã sản phẩm đã tồn tại',
            'price_regular.required' => 'price_regular không được để trống.',
            'price_regular.numeric' => 'price_regular phải là số.',
            'price_regular.min' => 'price_regular không được âm.',
            'price_sale.numeric' => 'price_sale phải là số.',
            'price_sale.min' => 'price_sale không được âm.',
            'price_sale.lt' => 'price_sale phải nhỏ hơn price_regular.',
            'descripton.max' => 'short_desc không được vượt quá 255 ký tự.',
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
            $productInput = $validator->validated();
            // dd($productInput);

            $product = $this->productRepository->updateById($productInput, $id);

            // Update Upload Avatar 
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

    public function delete($data) {
        
    }
}
