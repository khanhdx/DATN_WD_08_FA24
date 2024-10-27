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

    public function header()
    {
        $cartItems = [];

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cartItems = CartItem::with(['productVariant'])->where('cart_id', $cart->id)->latest('id')->get();

            $total = $cartItems->sum('sub_total');
        } else {
            $cartItems = session()->get('cart', []);

            $total = array_sum(array_column(session()->get('cart', []), 'sub_total'));
        }

        return view(self::PATH_VIEW . __FUNCTION__, compact('cartItems', 'total'));
    }
}
