<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\variant\StoreVariantRequest;
use App\Http\Requests\product\variant\UpdateVariantRequest;
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

    public function detail($id)
    {
        return $this->variantService->getOneById($id);
    }

    public function store(StoreVariantRequest $request)
    {
        try {
            return $this->variantService->insert($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $variant = $this->variantService->getOneById($id);

        // Lấy Info product
        $productId = $variant->product->id;
        $product = $this->productService->getOneById($productId);

        // Lấy thuộc tính 
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();

        return view('admin.products.variants.edit', compact('variant', ['product', 'colors', 'sizes']));
    }

    public function update(UpdateVariantRequest $request, $id)
    {

        try {
            return $this->variantService->update($request->all(), $id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function getAllAttribute()
    {
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();

        return view('admin.products.attributes.index', compact('colors', 'sizes'));
    }
}
