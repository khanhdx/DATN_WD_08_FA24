<?php

namespace App\Http\Controllers\Client;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ColorController;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    const PATH_VIEW = 'client.products.';
    public function index()
    {
        $products = Product::with(['category'])->latest('id')->paginate(9);
        $categories = Category::all();
        $colors = Color::all();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'products',
            'categories',
            'colors'
        ));
    }
    public function show(Product $product)
    {
        $product->load(['variants']);

        $sumStock = Product::find($product->id)->variants->sum('stock');

        $related_products = Product::with(['category'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'product',
            'related_products',
            'sumStock'
        ));
    }

    public function show_modal(Product $product)
    {
        try {
            $product->load(['variants', 'category', 'sizes', 'colors']);

            return response()->json($product);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 404);
        }
    }
    public function getColor(Request $request)
    {
        try {
            $productId = $request->product_id;
            $sizeId = $request->size_id;

            $colors = ProductVariant::query()
                ->where('product_id', $productId)
                ->where('size_id', $sizeId)
                ->get();

            return response()->json($colors);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 404);
        }
    }
    public function inStock(Request $request)
    {
        try {
            // $productId = $request->product_id;
            // $sizeId = $request->size_id;

            // $colors = ProductVariant::query()
            //     ->where('product_id', $productId)
            //     ->where('size_id', $sizeId)
            //     ->get();

            // return response()->json($colors);
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 404);
        }
    }
}
