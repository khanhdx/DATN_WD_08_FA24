<?php

namespace App\Services\Product;

use App\Repositories\ProductRepository;
use App\Repositories\VariantRepositopy;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductService implements IProductService
{
    protected $productRepository;

    protected $variantRepository;
    public function __construct(ProductRepository $productRepository, VariantRepositopy $variantRepository)
    {
        $this->productRepository = $productRepository;
        $this->variantRepository = $variantRepository;
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

        // try {
            $productInput = $data;
            $variants = $data['variants'];


            // Upload Image
            if (isset($productInput['image']) && $productInput['image'] instanceof \Illuminate\Http\UploadedFile) {
                $productInput['image'] = $productInput['image']->store('uploads/products', 'public');
            } else {
                $productInput['image'] = null;
            }
            // dd($productInput);

            //Insert lên DB
            $product = $this->productRepository->insert($productInput);

            if (isset($variants) && !empty($variants)) {
                $product_id = $product->id;

                foreach ($variants as $variant) {
                    $variant['product_id'] = $product_id;

                    $this->variantRepository->insert($variant);
                }

            }
            return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');
        // } catch (\Throwable $th) {
        //     return redirect()->back()->with('failed', $th->getMessage());
        // }
    }

    public function update($id, $data)
    {
        // Quy định lỗi
        $rules = [
            'category_id' => 'exists:categories,id',
            'name' => 'max:255|unique:products,name,' . $id,
            'description' => 'string|max:255',
            'price_regular' => 'numeric|min:0',
            'price_sale' => 'numeric|min:0|lt:price_regular',
            'image' => 'mimes:jpg,jpeg,png|max:2048',
            'old_image' => 'string',
        ];

        // Định nghĩa lỗi

        $messages = [
            'category_id.exists' => 'Danh mục không tồn tại.',
            'price_regular.numeric' => 'Giá gốc phải là số.',
            'price_regular.min' => 'Giá gốc không được âm.',
            'price_sale.numeric' => 'Giá khuyến mãi phải là số.',
            'price_sale.min' => 'Giá khuyến mãi không được âm.',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá gốc.',
            'descripton.max' => 'Mô tả ngắn không được vượt quá 255 ký tự.',
            'image.mimes' => 'Không đúng định dạng ảnh jpg,jpeg,png',
            'image.max' => 'Ảnh không vượt quá 2MB',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            // Redirect lại trang trước và đưa lỗi ra view
            return redirect()->back()
                ->withErrors($validator);
        }

        try {
            //update lên DB
            $productInput = $validator->validated();

            if (isset($productInput['image']) && ($productInput['image'] instanceof \Illuminate\Http\UploadedFile)) {
                $productInput['image'] =  $productInput['image']->store('uploads/products', 'public');
                Storage::disk('public')->delete($productInput['old_image']);
            } else {
                $productInput['image'] = $productInput['old_image'];
            }

            $this->productRepository->updateById($productInput, $id);
            return redirect()->route('admin.products.index')->with('success', 'Cập nhật sản phẩm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',  $th->getMessage());
        }
    }


    public function softDeleteById($id)
    {
        $product = $this->productRepository->getOneById($id);

        if (!$product) {
            return response([
                'error' => 'Sản phẩm không tồn tại',
            ], 404);
        }

        try {
            $this->productRepository->softDeleteById($id);

            return redirect()->route('admin.products.index')->with('success', 'Xóa sản phẩm thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errors', $th->getMessage());
        }
    }
}
