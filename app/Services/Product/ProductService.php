<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Models\ProductImage;
use App\Repositories\ProductRepository;
use App\Repositories\VariantRepositopy;
use App\Services\Inventory\InventoryService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductService implements IProductService
{
    protected $productRepository;

    protected $variantRepository;

    protected $inventoryService;

    public function __construct(ProductRepository $productRepository, VariantRepositopy $variantRepository, InventoryService $inventoryService)
    {
        $this->productRepository = $productRepository;
        $this->variantRepository = $variantRepository;
        $this->inventoryService = $inventoryService;
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
        DB::transaction(function () use ($data) {
             // dd($data);
        $productInput = $data;

        // Khởi tạo tồn kho tổng = 0
        $productInput['base_stock'] = 0;

        //Insert lên DB
        $product = $this->productRepository->insert($productInput);

         // Upload Image
         if (isset($productInput['image']) && $productInput['image'] instanceof \Illuminate\Http\UploadedFile) {
            ProductImage::create([
                'product_id' => $product->id,
                'image_url' => Storage::put('uploads/product_images', $productInput['image']),
                'type' => 'main',
            ]);

        }

        if (isset($data['variants']) && !empty($data['variants'])) {
            $variants = $data['variants'];
            $product_id = $product->id;

            foreach ($variants as $variant) {
                $variant['product_id'] = $product_id;

                $variant = $this->variantRepository->insert($variant);

                $variant_id = $variant->id;

                $initialStock = $variant['stock'] ?? 0;

                if ( $initialStock > 0 ) {
                    $this->inventoryService->importVariantStock($initialStock, $product_id, $variant_id);
                }
            }
        }
        }, 3);
        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công');
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

            $this->productRepository->updateById($productInput, $id);

            if (isset($productInput['image']) && ($productInput['image'] instanceof \Illuminate\Http\UploadedFile)) {
                $imageMain = ProductImage::find($id);
                $data['image_url'] = Storage::put('uploads/product_images', $productInput['image']);
                $imageMain->update($data);
            }

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

    public function search($keyword)
    {
        $products = $this->productRepository->search($keyword);

        // dd($products);

        return $products;
    }

    public function filter($request)
    {
        $query = Product::query();
        // $query->join('product_variants', 'products.id', '=', 'product_variants.product_id');

        // Lọc theo danh mục
        if ($request['category_id'] && $request['category_id'] != '') {
            $query->where('category_id', $request['category_id']);
        }
        // Lọc theo khoảng giá 
        if ($request['price_min'] && $request['price_min'] != '') {
            $query->where('price_regular', '>=', $request['price_min']);
        }

        if ($request['price_max'] && $request['price_max'] != '') {
            $query->where('price_regular', '<=', $request['price_max']);
        }

        // // Lọc theo trạng thái 
        // if($request['status'] && $request->status != ''){
        //     $query->where('status', $request->status);
        // }

        // Lọc theo khoảng ngày tạo sản phẩm
        if ($request['created_from'] && $request['created_from'] != '') {
            $query->where('created_at', '>=', $request['created_from']);
        }

        if ($request['created_to'] && $request['created_to'] != '') {
            $query->where('created_at', '<=', $request['created_to']);
        }

        // // Lọc số lượng tồn kho
        // if($request['stock') && $request->stock != ''){
        //     $query->where('stock','>=', $request->stock);
        // }

        // Lọc biến thể sản phẩm ( theo thuộc tính )
        if ($request['color_id'] && $request['color_id'] != '') {
            $query->where('product_variants.color_id', $request['color_id']);
        }

        if ($request['size_id'] && $request['size_id'] != '') {
            $query->where('product_variants.size_id', $request['size_id']);
        }

        // // Lọc theo rating 
        // if($request['rating'] && $request->rating != ''){
        //     $query->where('rating', $request->rating);
        // }

        $products = $query->select('products.*')->paginate(10);

        // dd($products);

        return $products;
    }
}
