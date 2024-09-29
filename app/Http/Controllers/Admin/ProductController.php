<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return $this->productService->getAll();
    }

    
    public function store(Request $request)
    {
        return $this->productService->insert($request->all());
    }   

    public function update($id, Request $request){
        return $this->productService->update($request->all(), $id);
    }
}
