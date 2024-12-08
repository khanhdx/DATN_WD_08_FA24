<?php

namespace App\Http\Controllers\Client;

use App\Models\Post;
use App\Models\Banner;
use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    const PATH_VIEW = 'client.home.';
    public function index()
    {
        $topSeller = Product::with(['category', 'image', 'variants.size', 'variants.color'])
            ->paginate(8);

        $newProductMan = Product::with(['category', 'image', 'variants.size', 'variants.color'])
            ->whereHas('category', function ($query) {
                $query->where('type', 'Man');
            })->latest('id')->get();

        $newProductWoman = Product::with(['category', 'image', 'variants.size', 'variants.color'])
            ->whereHas('category', function ($query) {
                $query->where('type', 'Woman');
            })->latest('id')->get();

        $latestPosts = Post::query()
            ->latest('id')
            ->paginate(2);

        $mainBanners = Banner::where('type', 'main')
            ->where('status', 1)
            ->get();

        $advertisementBanners = Banner::where('type', 'advertisement')
            ->where('status', 1)
            ->orderBy('created_at', 'desc') // Sắp xếp từ mới nhất
            ->take(3)
            ->get();

        // Lấy banner giới thiệu đầu tiên
        $introBanner = Banner::where('type', 'intro')
            ->where('status', 1)
            ->first();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'topSeller',
            'newProductMan',
            'newProductWoman',
            'latestPosts',
            'mainBanners',
            'advertisementBanners',
            'introBanner'
        ));
    }



    public function contact()
    {
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function header()
    {
        $cartItems = [];

        // $count = 0;

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $count = CartItem::with(['productVariant'])->where('cart_id', $cart->id)->latest('id')->count();

            $cartItems = CartItem::with(['productVariant'])->where('cart_id', $cart->id)->latest('id')->limit(3)->get();

            $total = $cartItems->sum('sub_total');
        } else {
            $count = session()->get('cart', []);

            $cartItems = collect($count)->sortByDesc('id')->take(3);

            $total = array_sum(array_column(session()->get('cart', []), 'sub_total'));
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('cartItems', 'total', 'count'));
    }
}
