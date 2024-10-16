<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $newProduct = Product::with(['category', 'variants.size', 'variants.color'])
            ->latest('id')
            ->get();

        $topSeller = Product::with(['category', 'variants.size', 'variants.color'])
            ->paginate(8);

        $latest_posts = Post::query()
            ->latest('id')
            ->paginate(2);

        return view('client.' . __FUNCTION__, compact(
            'newProduct',
            'topSeller',
            'latest_posts'
        ));
    }

    public function product_detail(Product $product)
    {
        $product->load(['category']);

        $related_products = Product::with(['category'])->latest('id')->get();

        return view('client.' . __FUNCTION__, compact('product', 'related_products'));
    }

    public function posts()
    {
        $posts = Post::paginate(6);

        return view('client.posts.' . __FUNCTION__, compact('posts'));
    }

    public function post_show($id)
    {
        $post_show = Post::findOrFail($id);;

        // Lấy 5 bài viết gần đây nhất
        $recentPosts = Post::orderBy('created_at', 'desc')->take(3)->get();

        // Lấy 5 bài viết được xem nhiều nhất
        $mostViewedPosts = Post::orderBy('views', 'desc')->take(5)->get();

        return view('client.posts.post_show', compact('post_show', 'recentPosts', 'mostViewedPosts'));
    }
    // public function post_make_show(Post $post)
    // {
    //     // Lấy 5 bài viết gần đây nhất
    //     $recentPosts = Post::orderBy('created_at', 'desc')->take(5)->get();

    //     // Lấy 5 bài viết được xem nhiều nhất
    //     $mostViewedPosts = Post::orderBy('views', 'desc')->take(5)->get();

    //     return view('client.posts.post_show', compact('post', 'recentPosts', 'mostViewedPosts'));
    // }

}
