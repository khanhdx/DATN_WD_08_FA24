<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\UpdateProductRequest;
use App\Models\Category;
use App\Services\Product\IProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(IProductService $productService)
    {

        $this->productService = $productService;
    }


    public function index()
    {
        $Category = new Category();
        $categories = $Category->all();

        $products = $this->productService->getAll();
        return view('admin.products.index', compact('products', ['categories']));
    }

    public function create()
    {
        // Lấy danh sách bảng categoreis
        $Category = new Category();
        $categories = $Category->all();

        return view('admin.products.create', compact('categories'));
    }

    public function getDetail($id)
    {
        $product = $this->productService->getOneById($id);

        return view('admin.products.detail', compact('product'));
    }

    public function edit($id)
    {
        // Lấy danh sách bảng categoreis
        $Category = new Category();
        $categories = $Category->all();

        $product = $this->productService->getOneById($id);
        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            return $this->productService->insert($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update($id, Request $request)
    {
        return $this->productService->update($id, $request->all());
    }

    public function delete($id)
    {
        return $this->productService->softDeleteById($id);
    }
}
