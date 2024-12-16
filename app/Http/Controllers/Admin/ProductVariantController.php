<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\variant\StoreVariantRequest;
use App\Http\Requests\product\variant\UpdateVariantRequest;
use App\Models\Product;
use App\Models\ProductVariant;
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


    public function index(Request $request)
    {
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();

        $color_id = $request->query('color');
        $size_id = $request->query('size');
    

        if ($color_id == null && $size_id == null) {
            $variants =  $this->variantService->getAll();
        } else {
            $variants = $this->filter($color_id, $size_id);

        }

        
        $variants = $variants->appends([
            'color' => $color_id,
            'size' => $size_id,
        ]);

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
        $colors = $this->colorService->getAllPaginate();
        $sizes = $this->sizeService->getAll();

        return view('admin.products.attributes.index', compact('colors', 'sizes'));
    }


    public function filter($color_id, $size_id)
    {
        $filtedVariants = ProductVariant::query()
            ->when($color_id, function ($query, $color_id) {
                return $query->where('color_id', $color_id);
            })
            ->when($size_id, function ($query, $size_id) {
                return $query->where('size_id', $size_id);
            })
            ->paginate(10);

        return $filtedVariants;
    }

    public function search(Request $request)
    {
        $keyword = $request->query('keyword');
        $products = Product::where('name', 'like', '%' . $keyword . '%');
        $productIds = $products->pluck('id');
        $variantsQuery = ProductVariant::query()
            ->whereIn('product_id', $productIds);
       
        $variants = $variantsQuery->paginate(10)->appends(['keyword' => $keyword]);
        //  dd($variants);
        $colors = $this->colorService->getAll();
        $sizes = $this->sizeService->getAll();

        return view('admin.products.variants.index', compact('variants', ['colors', 'sizes']));
        
    }
}
