<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\StoreProductRequest;
use App\Http\Requests\product\UpdateProductRequest;
use App\Models\Category;
use App\Services\Color\IColorService;
use App\Services\Product\IProductService;
use App\Services\Size\ISizeService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $colorService;
    protected $sizeService;


    public function __construct(IProductService $productService, IColorService $iColorService, ISizeService $iSizeService)
    {
        $this->productService = $productService;
        $this->colorService = $iColorService;
        $this->sizeService = $iSizeService;
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

        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();

        return view('admin.products.create', compact('categories', ['colors', 'sizes']));
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
