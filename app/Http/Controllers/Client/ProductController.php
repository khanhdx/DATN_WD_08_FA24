<?php

namespace App\Http\Controllers\Client;

use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
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
        $related_products = Product::with(['category'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'product',
            'related_products'
        ));
    }

    public function show_modal(Product $product) {
        $product->load(['category', 'sizes', 'colors']);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        
        return response()->json($product);
    }
}
