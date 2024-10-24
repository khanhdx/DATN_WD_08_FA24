<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    const PATH_VIEW = 'client.';
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
            $banners = Banner::where('status', 1)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'newProduct',
            'topSeller',
            'latest_posts',
            'banners'
        ));
    }
    public function contact() {
        return view(self::PATH_VIEW . __FUNCTION__);
    }
}
