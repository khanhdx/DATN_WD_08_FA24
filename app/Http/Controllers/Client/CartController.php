<?php

namespace App\Http\Controllers\Client;

use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\Double;

class CartController extends Controller
{
    const PATH_VIEW = 'client.cart.';

    public function index()
    {
        // dd(session()->get('cart'));
        return view(self::PATH_VIEW . __FUNCTION__);
    }

    public function cart()
    {
        $cartItems = [];

        if (Auth::check()) {
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            $cartItems = CartItem::with(['productVariant'])->where('cart_id', $cart->id)->latest('id')->get();

            $total = $cartItems->sum('sub_total');
        } else {
            $cartItems = collect(session()->get('cart', []))->sortByDesc('id');

            $total = array_sum(array_column(session()->get('cart', []), 'sub_total'));
        }
        // dd($cartItems);

        return view(self::PATH_VIEW . __FUNCTION__, compact('cartItems', 'total'));
    }

    public function addToCart(Request $request)
{
    try {
        // Tìm kiếm product_variant theo các thông tin được truyền vào
        $productVariant = ProductVariant::where('product_id', $request->product_id)
            ->where('color_id', $request->color_id)
            ->where('size_id', $request->size_id)
            ->firstOrFail();

        $sub_total = $request->quantity * $productVariant->price;

        // Kiểm tra nếu số lượng yêu cầu vượt quá số lượng trong kho
        if ($request->quantity > $productVariant->stock) {
            return response()->json([
                'message' => "Rất tiếc, bạn chỉ có thể mua tối đa $productVariant->stock sản phẩm!",
                'status_code' => 500,
            ]);
        }

        if (Auth::check()) {
            // Nếu người dùng đã đăng nhập
            $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

            // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
            $cart_item = CartItem::where('cart_id', $cart->id)
                ->where('product_variant_id', $productVariant->id)->first();

            if ($cart_item) {
                // Nếu có, cập nhật số lượng và tổng tiền
                $quantity = $cart_item->quantity;
                $cart_item->quantity += $request->quantity;

                if ($cart_item->quantity > $productVariant->stock) {
                    return response()->json([
                        'message' => "Bạn đã có $quantity sản phẩm trong giỏ hàng. Không thể mua thêm vì VƯỢT QUÁ số lượng cho phép!",
                        'status_code' => 500,
                    ]);
                }

                $cart_item->sub_total += $sub_total;
                $cart_item->save();
            } else {
                // Nếu chưa có, thêm mới sản phẩm vào giỏ hàng
                CartItem::create([
                    'cart_id'             => $cart->id,
                    'product_variant_id'  => $productVariant->id,
                    'product_id'          => $productVariant->product_id, // Lưu product_id
                    'quantity'            => $request->quantity,
                    'sub_total'           => $sub_total,
                ]);
            }
        } else {
            // Nếu người dùng chưa đăng nhập, lưu giỏ hàng vào session
            $cart = session()->get('cart', []);
            $key = $productVariant->id;

            $newId = 1;
            if (!empty($cart)) {
                $maxId = max(array_column($cart, 'id'));
                $newId = $maxId + 1;
            }

            // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
            if (isset($cart[$key])) {
                $quantity = $cart[$key]['quantity'];

                $cart[$key]['quantity'] += $request->quantity;

                if ($cart[$key]['quantity'] > $productVariant->stock) {
                    return response()->json([
                        'message' => "Bạn đã có $quantity sản phẩm trong giỏ hàng. Không thể mua thêm vì VƯỢT QUÁ số lượng cho phép!",
                        'status_code' => 500,
                    ]);
                }

                $cart[$key]['sub_total'] += $sub_total;
            } else {
                // Nếu chưa có, thêm mới sản phẩm vào giỏ hàng session
                $cart[$key] = [
                    'id'            => $newId,
                    'image'         => $productVariant->product->image,
                    'name'          => $productVariant->product->name,
                    'color'         => $productVariant->color->name,
                    'size'          => $productVariant->size->name,
                    'quantity'      => $request->quantity,
                    'price'         => $productVariant->price,
                    'sub_total'     => $sub_total,
                    'product_id'    => $productVariant->product_id, // Lưu product_id
                    'product_variant_id' => $productVariant->id, // Lưu product_variant_id
                ];
            }
            session()->put('cart', $cart);
        }

        return response()->json([
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng thành công!',
            'status_code' => 200,
        ]);
    } catch (\Throwable $th) {
        return response()->json([
            'message' => 'Có lỗi trong quá trình thêm giỏ hàng!',
            'errors' => $th->getMessage()
        ]);
    }
}

    public function updateCart(Request $request, string $id)
    {
        try {
            $productVariant = ProductVariant::where('id', $request->product_variant_id)->firstOrFail();

            $sub_total = $request->quantity * $productVariant->price;

            if ($request->quantity > $productVariant->stock) {
                return response()->json([
                    'message' => "Rất tiếc, bạn chỉ có thể mua tối đa $productVariant->stock sản phẩm!",
                    'quantity' => $productVariant->stock,
                    'status_code' => 500,
                ]);
            }

            if (Auth::check()) {
                if ($request->quantity > 0) {
                    $cart_item = CartItem::find($id);

                    $data = [
                        'quantity' => $request->quantity,
                        'sub_total' => $sub_total
                    ];

                    $cart_item->update($data);
                }
            } else {
                session()->put("cart.$id.quantity", $request->quantity);

                session()->put("cart.$id.sub_total", $sub_total);
            }

            return response()->json([
                'message' => 'Cập nhật giỏ hàng thành công!',
                'status_code' => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Đã xảy ra lỗi trong quá trình cập nhật',
                'errors' => $th->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            if (Auth::check()) {
                $cart_item = CartItem::where('id', $id)->firstOrFail();

                $cart_item->delete();
            } else {
                session()->forget("cart.$id");
            }

            return response()->json([
                'message' => 'Xóa giỏ hàng thành công!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Xóa giỏ hàng không thành công!',
            ]);
        }
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
                    $cart_item->sub_total += $item['sub_total'];
                    $cart_item->save();
                } else {
                    CartItem::updateOrCreate([
                        'cart_id'             => $cart->id,
                        'product_variant_id'  => $productVariant,
                        'quantity'            => $item['quantity'],
                        'sub_total'               => $item['sub_total'],
                    ]);
                }
            }

            session()->forget('cart');
        }
    }
}
