<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    const VIEW_CART = 'client.cart.';

    public function index()
    {
        // session()->forget('cart');
        $carts = [];

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $carts = CartItem::with('productVariant')->where('cart_id', $cart->id)->latest('id')->get();
        } else {
            $carts = session()->get('cart', []);
        }
        // dd($carts);

        return view(self::VIEW_CART . __FUNCTION__, compact('carts'));
    }

    public function addToCart(Request $request)
    {
        $productVariant = ProductVariant::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->firstOrFail();

        $price = $request->quantity * $productVariant->price;

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cart_item = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $productVariant->id)->first();

            if ($cart_item) {
                $cart_item->quantity += $request->quantity;
                $cart_item->price += $price;
                $cart_item->save();
            } else {
                CartItem::create([
                    'cart_id'             => $cart->id,
                    'product_variant_id'  => $productVariant->id,
                    'quantity'            => $request->quantity,
                    'price'               => $price,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            $key = $productVariant->id;

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] += $request->quantity;
                $cart[$key]['total'] += $price;
            } else {
                $cart[$key] = [
                    'image'              => $productVariant->product->image,
                    'name'               => $productVariant->product->name,
                    'color'              => $productVariant->color->name,
                    'size'               => $productVariant->size->name,
                    'quantity'           => $request->quantity,
                    'price'              => $productVariant->price,
                    'total'              => $price,
                ];
            }

            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function updateCart(Request $request, string $id)
    {
        $productVariant = ProductVariant::where('id', $request->product_variant_id)->firstOrFail();

        $price = $request->quantity * $productVariant->price;

        if (Auth::check()) {

            if ($request->quantity > 0) {
                $cart_item = CartItem::where('id', $id)->firstOrFail();

                $cart_item->quantity = $request->quantity;

                $cart_item->price = $price;

                $cart_item->save();
            }
        } else {
            session()->put("cart.$id.quantity", $request->quantity);
            session()->put("cart.$id.total", $price);
        }

        return back()->with('success', 'Cập nhật giỏ hàng thành công');
    }

    public function destroy(string $id)
    {
        if (Auth::check()) {
            $cart_item = CartItem::where('id', $id)->firstOrFail();

            $cart_item->delete();
        } else {
            session()->forget("cart.$id");
        }

        return back();
    }

    public function sessionCartToDatabase()
    {
        if (!Auth::check()) {
            return;
        }

        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            foreach ($sessionCart as $productVariant => $item) {
                $cart_item = CartItem::where('cart_id', $cart->id)
                    ->where('product_variant_id', $productVariant)->first();

                if ($cart_item) {
                    $cart_item->quantity += $item['quantity'];
                    $cart_item->price += $item['total'];
                    $cart_item->save();
                } else {
                    CartItem::updateOrCreate([
                        'cart_id'             => $cart->id,
                        'product_variant_id'  => $productVariant,
                        'quantity'            => $item['quantity'],
                        'price'               => $item['total'],
                    ]);
                }
            }

            session()->forget('cart');
        }
    }
}
