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
        $topSeller = Product::with(['category', 'variants.size', 'variants.color'])
            ->paginate(8);

        $newProductMan = Product::with(['category', 'variants.size', 'variants.color'])
            ->whereHas('category', function ($query) {
                $query->where('type', 'Man');
            })->latest('id')->paginate(12);

        $newProductWoman = Product::with(['category', 'variants.size', 'variants.color'])
            ->whereHas('category', function ($query) {
                $query->where('type', 'Woman');
            })->latest('id')->paginate(12);

        $latestPosts = Post::query()
            ->latest('id')
            ->paginate(2);

        $banners = Banner::where('status', 1)->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact(
            'topSeller',
            'newProductMan',
            'newProductWoman',
            'latestPosts',
            'banners'
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
