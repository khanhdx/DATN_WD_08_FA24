<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Color\IColorService;
use App\Services\Product\IProductService;
use App\Services\Product\IVariantService;
use App\Services\Size\ISizeService;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    protected $variantService;
    protected $colorService;
    protected $sizeService;
    protected $productService;


    public function __construct(IVariantService $iVariantService, IColorService $iColorService, ISizeService $iSizeService, IProductService $iProductService)
    {
        $this->variantService = $iVariantService;
        $this->colorService = $iColorService;
        $this->sizeService = $iSizeService;
        $this->productService = $iProductService;
    }


    public function index()
    {
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();

        $variants =  $this->variantService->getAll();

        return view('admin.products.variants.index', compact('variants', ['colors', 'sizes']));
    }

    public function create($id)
    {
        // Lấy thuộc tính 
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();
        

        $product = $this->productService->getOneById($id);

        return view('admin.products.variants.create', compact('product', ['sizes', 'colors']));
    }


    public function store(Request $request)
    {
       return $this->variantService->insert($request->all());
    }

    public function update(Request $request, $id)
    {

        return $this->variantService->update($request->all(), $id);
    }
}
