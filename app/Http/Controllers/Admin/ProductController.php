<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $products = $this->productService->getAll();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        // Lấy danh sách bảng categoreis
        $Category = new Category();
        $categories = $Category->all();

        return view('admin.products.create', compact('categories'));
    }



    public function edit($id)
    {
        // Lấy danh sách bảng categoreis
        $Category = new Category();
        $categories = $Category->all();

        $product = $this->productService->getOneById($id);
        return view('admin.products.edit', compact('categories', 'product'));
    }

    public function store(Request $request)
    {

        return $this->productService->insert($request->all());
    }

    public function update($id, Request $request)
    {
        return $this->productService->update($request->all(), $id);
    }
}
