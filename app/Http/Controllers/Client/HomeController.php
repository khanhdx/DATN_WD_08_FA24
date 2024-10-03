<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newProduct = Product::with(['category'])->latest('id')->get();

        $topSeller = Product::with(['category'])->paginate(8);

        $latest_posts = Post::query()->latest('id')->paginate(2);

        return view('client.' . __FUNCTION__, compact('newProduct','topSeller','latest_posts'));
    }
    public function product_detail(Product $product)
    {
        $product->load(['category']);

        $related_products = Product::with(['category'])->latest('id')->get();

        return view('client.' . __FUNCTION__, compact('product','related_products'));
    }

    public function posts()
    {
        $posts = Post::paginate(6);

        return view('client.posts.' . __FUNCTION__, compact('posts'));
    }

    public function post_show($id)
    {
        $post_show = Post::query()->findOrFail($id);

        return view('client.posts.' . __FUNCTION__, compact('post_show'));
    }
}
