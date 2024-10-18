<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    const PATH_VIEW = 'client.products.';

    public function index()
    {
        $products = Product::with(['category'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'products'
        ));
    }

    public function show(Product $product)
    {
        $product->load(['category']);

        $related_products = Product::with(['category'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'product',
            'related_products'
        ));
    }
}
