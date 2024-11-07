<?php

namespace App\Http\Controllers\Client;

use App\Models\Color;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\ColorController;

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
            $product->load(['variants', 'category', 'sizes', 'colors' ]);

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
    public function getInStock(Request $request)
    {
        try {
            $productId = $request->product_id;
            $sizeId = $request->size_id;
            $colorId = $request->color_id;

            if ($sizeId && $colorId) {
                $data = ProductVariant::query()
                    ->select(DB::raw("SUM(stock) as stock, REPLACE(FORMAT(price, 0), ',', '.') as price"))
                    ->where('product_id', $productId)
                    ->where('color_id', $colorId)
                    ->where('size_id', $sizeId)
                    ->groupBy('price')
                    ->get();

                return response()->json($data);
            } elseif ($colorId) {
                $data = ProductVariant::query()
                    ->where('product_id', $productId)
                    ->where('color_id', $colorId)
                    ->sum('stock');

                return response()->json($data);
            } else {
                $data = ProductVariant::query()
                    ->where('product_id', $productId)
                    ->where('size_id', $sizeId)
                    ->sum('stock');

                return response()->json($data);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'errors' => $th->getMessage()
            ], 404);
        }
    }

}
