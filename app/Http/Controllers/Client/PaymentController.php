<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Models\AtmMomo;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\StatusOrderDetail;
use App\Models\Voucher;
use App\Models\vouchersWare;
use App\Models\VoucherWare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        $cartId = auth()->check() ? Cart::where('user_id', auth()->id())->value('id') : Session::get('cart_id');

        if (!$cartId) {
            return redirect()->route('client.carts.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        $cartItems = CartItem::where('cart_id', $cartId)->with('productVariant')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('client.home')->with('error', 'Giỏ hàng trống.');
        }
        return view('client.checkouts.index', compact('cartItems'));
    }
    public function showGuestPaymentForm()
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        // dd($cart);

        // Kiểm tra nếu giỏ hàng trống
        if (empty($cart)) {
            return redirect()->route('guest.carts.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Lấy các phần tử giỏ hàng và tính toán lại sub_total
        $cartItems = collect($cart)->map(function ($item) {
            // Kiểm tra các trường bắt buộc
            if (isset($item['price'], $item['quantity'])) {
                // Tính lại sub_total dựa trên price và quantity
                $item['sub_total'] = $item['price'] * $item['quantity'];
            }
            return $item;
        });

        // Tính tổng giỏ hàng
        $totalPrice = $cartItems->sum('sub_total');

        // Kiểm tra kết quả
        // dd($cartItems, $totalPrice); // Sử dụng dd để kiểm tra dữ liệu trong quá trình phát triển

        return view('client.checkouts.index', compact('cartItems', 'totalPrice'));
    }

    public function processVoucher(Request $request)
    {
        $voucher_id = $request->input('voucher_id');
        $voucher = Voucher::where('id', '=', $voucher_id)->first();
        $today = date('Y-m-d');
        if ($voucher->date_start <= $today && $voucher->date_end >= $today && $voucher->remaini > 0) {
            return response()->json(["status" => 200, "voucher" => $voucher]);
        } else {
            return response()->json(['errors' => "Mã đã hết hạn hoặc hết lượng sử dụng!", "status" => 400]);
        }
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward_street' => 'required|string',
            'ship_fee' => 'required|integer',
            'payment_method' => 'required|string',
        ]);

        // dd($request->all());

        $cartId = auth()->check() ? Cart::where('user_id', auth()->id())->value('id') : Session::get('cart_id');

        if (!$cartId) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
        }

        $cartItems = CartItem::with('productVariant')->where('cart_id', $cartId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->totalPrice();
        }

        $voucherDiscount = 0;
        $today = date('Y-m-d');
        $voucher_id = $request->input('Vs_code');
        // Kiểm tra mã giảm giá
        if ($request->input('Vs_code') != null && Auth::user()) {
            // Kiểm tra lại mã tồn tại trong kho
            $voucher_wave = vouchersWare::query()->where('user_id', '=', Auth::user()->id)->first();
            $wavein = $voucher_wave->wares_list->where('status', '=', 'Chưa sử dụng')->where('voucher_id', '=', $voucher_id)->first();
            $voucher = $wavein->voucher;
            // Kiểm tra điều kiện sử dụng
            if ($totalPrice >= $voucher->condition) {
                // Kiểm tra hạn sử dụng và số lượng của mã
                if ($voucher && $voucher->date_start <= $today && $voucher->date_end >= $today && $voucher->remaini > 0) {
                    // Kiểm tra hình thức giảm 
                    if ($voucher->value == 'Phần trăm') {
                        $voucherDiscount = floor($totalPrice * ($voucher->decreased_value / 100));
                        if ($voucherDiscount > $voucher->max_value) {
                            $voucherDiscount = $voucher->max_value;
                        }
                    } else {
                        $voucherDiscount = $voucher->max_value;
                    }
                } else {
                    $voucher_id = null;
                    return redirect()->route('checkout')->with('error', 'Voucher đã hết!.');
                }
            } else {
                return redirect()->route('checkout')->with('error', 'Đơn hàng không đủ điều kiện sử dụng voucher này.');
            }
        } else {
            $voucher_id = null;
        }
        $totalPrice -= $voucherDiscount;

        $totalPrice = max($totalPrice, 0);

        if ($totalPrice > 50000000) {
            return redirect()->route('checkout')->with('error', 'Giá trị COD không được vượt quá 50 triệu');
        }

        $items = [];
        $weight = 100;
        $quantityCart = 0;

        foreach ($cartItems as $item) {
            $items[] = [
                'name' => $item->productVariant->product->name,
                'quantity' => $item->quantity,
                'weight' => $item->quantity * $weight,
            ];
            $quantityCart += $item->quantity;
        }

        try {
            $response = Http::withHeaders([
                'Token' => env('TOKEN_GHN'),
                'ShopId' => env('SHOP_ID')
            ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', [
                'payment_type_id' => 2,
                'note' => $request->note,
                'required_note' => "KHONGCHOXEMHANG",
                'to_name' => $request->user_name,
                'to_phone' => $request->phone_number,
                'to_address' => $request->address,
                'to_ward_name' => $request->ward_street,
                'to_district_name' => $request->district,
                'to_province_name' => $request->province,
                'cod_amount' => $request->payment_method === 'MOMO' ? 0 : $totalPrice,
                'weight' => $quantityCart * $weight,
                'service_type_id' => 2,
                'items' => $items
            ]);

            $order_code = [];
            $data = $response->json();

            if ($response->successful()) {
                $order_code = data_get($response, 'data.order_code', 'Không có mã đơn hàng');
                Log::info('Tạo Đơn Thành Công: ' . $response->body());
            } else {
                // Xử lý lỗi API
                Log::error('API GHN Error: ' . $response->body());

                return redirect()->route('checkout')->with('error', $data['code_message_value']);
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => $order_code,
                'shipping_fee' => $request->ship_fee,
                'slug' => $this->generateSlug(),
                'user_name' => $request->user_name,
                'email' => $request->email,
                'total_price' => $totalPrice,
                'voucher_id' => $voucher_id,
                'status_order_id' => 1,
                'phone_number' => $request->phone_number,
                'date' => now(),
                'address' => $request->address,
                'note' => $request->note,
            ]);


            foreach ($cartItems as $item) {
                // Xu ly ton tren 1 san pham bien the
                $productVariant = $item->productVariant;
                $productVariant->decrement('stock', $item->quantity);
                $product_id = $item->productVariant->product_id;
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->productVariant->product_id,
                    'product_variant_id' => $item->productVariant->id,
                    'name_product' => $item->productVariant->product->name,
                    'color' => $item->productVariant->color->name ?? null,
                    'size' => $item->productVariant->size->name ?? null,
                    'unit_price' => $item->productVariant->price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->totalPrice(),
                ]);
    
                Product::where('id', $item->productVariant->product_id)->decrement('base_stock', $item->quantity);
            }

           
            
            StatusOrderDetail::create([
                'status_order_id' => 1,
                'order_id' => $order->id,
                'name' => $request->payment_method === 'MOMO' ? 'MOMO' : 'COD',
            ]);
            // Cập nhật lại trạng thái voucher trong kho sau khi sử dụng (Sử dụng mã)
            if ($voucher_id) {
                $voucher_wave = vouchersWare::query()->where('user_id', '=', Auth::user()->id)->first(); //Mã kho
                $wavein = $voucher_wave->wares_list->where('status', '=', 'Chưa sử dụng')->where('voucher_id', '=', $voucher_id)->first(); //Voucher trong kho
                $voucher = $wavein->voucher; //Voucher trên hệ thống
                // Cập nhật trạng thái
                $wavein->status = "Đã sử dụng";
                $wavein->save();
                // Cập nhật số lượng
                $voucher->remaini = $voucher->remaini - 1;
                $voucher->save();
                VoucherWare::create([
                    'user_id' => auth()->id(),
                    'voucher_id' => $voucher->id,
                    'order_id' => $order->id,
                ]);
            }
            if ($request->payment_method === 'MOMO') {
                return $this->processMoMoPayment($order);
            }
            Payment::create([
                'order_id' => $order->id,
                'user_id' => auth()->id(),
                'amount' => $totalPrice,
                'transaction_type' => 0,
                'payment_method' => $request->payment_method,
                'status' => 0,
            ]);

            // Thống báo admin
            broadcast(new OrderEvent($order));
        } catch (\Exception $e) {
            Log::error('Error while creating order: ' . $e->getMessage());
            if (isset($order)) {
                $order->delete(); // Xóa đơn hàng nếu có lỗi xảy ra
            }
            return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra khi lưu đơn hàng. Vui lòng thử lại.');
        }

        CartItem::where('cart_id', $cartId)->delete();
        session()->forget('voucher_id');
        session()->forget('discount');

        return redirect()->route('payment.success')->with('success', 'Đặt hàng thành công!');
    }

    public function guestCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'payment_method' => 'required|string',
            'phone_number' => 'required|string|max:15',
            'province' => 'required|string',
            'district' => 'required|string',
            'ward_street' => 'required|string',
            'ship_fee' => 'required|integer',
        ]);

        // dd($request->all());
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);
        // dd($cart);
        if (empty($cart)) {
            return redirect()->route('guest.carts.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        // Chuyển dữ liệu giỏ hàng thành collection
        $cartItems = collect($cart)->map(function ($item) {
            // Kiểm tra và đảm bảo rằng product_id và product_variant_id không bị null
            if (empty($item['product_id']) || empty($item['product_variant_id'])) {
                Log::error("Missing product_id or product_variant_id for item: " . json_encode($item));
                throw new \Exception("Sản phẩm không hợp lệ. Vui lòng thử lại.");
            }

            $item['sub_total'] = $item['price'] * $item['quantity'];

            // Đảm bảo rằng các trường product_id và product_variant_id được cung cấp đúng
            return (object) $item; // Chuyển dữ liệu thành đối tượng stdClass
        });

        if ($cartItems->isEmpty()) {
            return redirect()->route('guest.checkout')->with('error', 'Giỏ hàng trống.');
        }

        // Tính tổng giá trị đơn hàng
        $totalPrice = $cartItems->sum('sub_total');
        $voucherDiscount = 0; //Cần đăng nhập để sử dụng voucher.
        $totalPrice -= $voucherDiscount;
        $totalPrice = max($totalPrice, 0);

        if ($totalPrice > 50000000) {
            return redirect()->route('guest.checkout')->with('error', 'Giá trị COD không được vượt quá 50 triệu');
        }

        $items = [];
        $weight = 100;
        $quantityCart = 0;

        foreach ($cartItems as $item) {
            $items[] = [
                'name' => $item->name,
                'quantity' => (int) $item->quantity,
                'weight' => $item->quantity * $weight,
            ];
            $quantityCart += $item->quantity;
        }

        try {
            $response = Http::withHeaders([
                'Token' => env('TOKEN_GHN'),
                'ShopId' => env('SHOP_ID')
            ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create', [
                'payment_type_id' => 2,
                'note' => $request->note,
                'required_note' => "KHONGCHOXEMHANG",
                'to_name' => $request->user_name,
                'to_phone' => $request->phone_number,
                'to_address' => $request->address,
                'to_ward_name' => $request->ward_street,
                'to_district_name' => $request->district,
                'to_province_name' => $request->province,
                'cod_amount' => $request->payment_method === 'MOMO' ? 0 : $totalPrice,
                'weight' => $quantityCart * $weight,
                'service_type_id' => 2,
                'items' => $items
            ]);

            $order_code = [];
            $data = $response->json();
          

            if ($response->successful()) {
                $order_code = data_get($response, 'data.order_code', 'Không có mã đơn hàng');
                Log::info('Tạo đơn thành công cho khách vãng lai: ' . $response->body());
            } else {
                // Xử lý lỗi API
                Log::error('API GHN Error: ' . $response->body());


                return redirect()->route('guest.checkout')->with('error', $data['code_message_value']);
            }

            // Tạo đơn hàng cho khách vãng lai
            $order = Order::create([
                'user_id' => null,
                'order_code' => $order_code,
                'shipping_fee' => $request->ship_fee,
                'slug' => $this->generateSlug(),
                'user_name' => $request->user_name,
                'email' => $request->email,
                'total_price' => $totalPrice,
                'voucher_id' => null,
                'status_order_id' => 1, // Trạng thái chờ xử lý
                'phone_number' => $request->phone_number,
                'date' => now(),
                'address' => $request->address,
                'note' => $request->note,
            ]);

            // Tạo chi tiết đơn hàng
            foreach ($cartItems as $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_variant_id' => $item->product_variant_id,
                    'name_product' => $item->name,
                    'color' => $item->color ?? null,
                    'size' => $item->size ?? null,
                    'unit_price' => $item->price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->sub_total,
                ]);
            }

            $totalQuantity = 0;
            $product_id = null;
            foreach ($cartItems as $item) {
                // Xu ly ton tren 1 san pham bien the
                $productVariant = $item->productVariant;
                $productVariant->decrement('stock', $item->quantity);
                $product_id = $item->productVariant->product_id;
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item->productVariant->product_id,
                    'product_variant_id' => $item->productVariant->id,
                    'name_product' => $item->productVariant->product->name,
                    'color' => $item->productVariant->color->name ?? null,
                    'size' => $item->productVariant->size->name ?? null,
                    'unit_price' => $item->productVariant->price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->totalPrice(),
                ]);
                $totalQuantity += $item->quantity;
            }

            // Trừ tổng tồn kho
            Product::where('id', $product_id)->decrement('base_stock', $totalQuantity);


            StatusOrderDetail::create([
                'status_order_id' => 1,
                'order_id' => $order->id,
                'name' => $request->payment_method === 'MOMO' ? 'MOMO' : 'COD',
            ]);

            Payment::create([
                'order_id' => $order->id,
                'user_id' => null, // Sử dụng UUID cho thanh toán
                'amount' => $totalPrice,
                'transaction_type' => 0,
                'payment_method' => $request->payment_method,
                'status' => 0, // Chờ thanh toán
            ]);


            // Thông báo admin
            broadcast(new OrderEvent($order));
        } catch (\Exception $e) {
            Log::error('Error while creating guest order: ' . $e->getMessage());
            if (isset($order)) {
                $order->delete(); // Xóa đơn hàng nếu có lỗi xảy ra
            }
            return redirect()->route('guest.checkout')->with('error', 'Có lỗi xảy ra khi lưu đơn hàng. Vui lòng thử lại.');
        }
        // Người dùng cần đăng nhập để sử dụng voucher.
        // Xử lý voucher nếu có
        // $voucherId = session('voucher_id');
        // if ($voucherId) {
        //     $voucher = Voucher::find($voucherId);
        //     if ($voucher && $voucher->quanlity > 0) {
        //         $voucher->quanlity -= 1;
        //         $voucher->save();
        //     }
        // }

        // Lưu order_id vào session
        session()->put('order_id', $order->id);
        // Xóa giỏ hàng
        session()->forget('cart');
        session()->forget('voucher_id');
        session()->forget('discount');

        return redirect()->route('guest.payment.success')->with('success', 'Đặt hàng thành công!');
    }

    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function processMoMoPayment($order)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $order->total_price;  // Chuyển giá trị thành tiền đồng
        $orderId = time();
        $redirectUrl = route('payment.momo');
        $ipnUrl = route('payment.momo');
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        // dd($data);

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);


        if ($jsonResult['resultCode'] == 0) {
            return redirect($jsonResult['payUrl']);
        } else {
            return redirect()->route('checkout')->with('error', 'Lỗi khi xử lý thanh toán MoMo.');
        }
    }

    public function paymentMomo(Request $request)
    {
        try {
            Log::info('MoMo payload:', $request->all());

            $order = Order::where('user_id', Auth::id())
                ->whereHas('statusOrderDetails', function ($query) {
                    $query->where('status_order_id', 1);
                })
                ->latest()
                ->first();

            if (!$order) {
                return redirect()->route('checkout')->with('error', 'Không tìm thấy đơn hàng hợp lệ.');
            }

            if ($request->resultCode != 0) { // Giao dịch thất bại
                // Xóa đơn hàng và các bản ghi liên quan
                $order->orderDetails()->delete();
                $order->statusOrderDetails()->delete();
                $order->delete();
                $this->deleteOrderGHN($order->order_code);
                return redirect()->route('checkout')->with('error', 'Thanh toán không thành công. Đơn hàng đã được hủy.');
            }

            // Lưu thông tin thanh toán nếu thành công
            Payment::create([
                'order_id' => $order->id,
                'user_id' => $order->user_id,
                'amount' => intval($request->amount),
                'transaction_type' => 1,
                'payment_method' => 'MoMo',
                'status' => 1,
                'note' => 'Thanh toán thành công qua MoMo.',
            ]);

            $this->clearCart();

            return redirect()->route('payment.success')->with('success', 'Thanh toán thành công!');
        } catch (\Exception $e) {
            Log::error('Error in paymentMomo: ' . $e->getMessage());

            if (isset($order)) {
                $order->orderDetails()->delete();
                $order->statusOrderDetails()->delete();
                $order->delete();
            }

            return redirect()->route('checkout')->with('error', 'Lỗi xảy ra khi xử lý thanh toán. Đơn hàng đã được hủy.');
        }
    }

    public function paymentSuccessForUser()
    {
        if (auth()->check()) {
            $orders = Order::where('user_id', auth()->id())->latest()->first();
            if (!$orders) {
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }

            // Lấy thông tin thanh toán từ bảng Payment
            $payment = Payment::where('order_id', $orders->id)->first();

            // Truyền dữ liệu thanh toán vào view
            return view('client.checkouts.success', compact('orders', 'payment'));
        } else {
            if (!session()->has('order')) {
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }
            $orders = session('order');

            // Lấy thông tin thanh toán từ bảng Payment
            $payment = Payment::where('order_id', $orders['id'])->first();

            // Truyền dữ liệu thanh toán vào view
            return view('client.checkouts.success', compact('orders', 'payment'));
        }
    }

    public function paymentSuccessForGuest()
    {
        // Lấy order_id từ session
        $orderId = session('order_id');
        if (!$orderId) {
            return redirect()->route('client.home')->with('error', 'Bạn chưa đặt hàng.');
        }

        // Tìm đơn hàng theo order_id
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('client.home')->with('error', 'Đơn hàng không tồn tại.');
        }

        // Lấy thông tin thanh toán
        $payment = Payment::where('order_id', $order->id)->first();

        // Truyền dữ liệu sang view
        return view('client.checkouts.success', compact('order', 'payment'));
    }


    private function clearCart()
    {
        $cartId = auth()->check()
            ? Cart::where('user_id', auth()->id())->value('id')
            : Session::get('cart_id');

        if ($cartId) {
            // Xóa tất cả các mục trong giỏ hàng
            CartItem::where('cart_id', $cartId)->delete();

            // Xóa giỏ hàng nếu là khách vãng lai
            if (!auth()->check()) {
                Session::forget('cart_id');
            }
        }
    }
    protected function generateSlug()
    {
        $randomNumber = rand(1000, 9999);
        $date = now()->format('Ymd');
        return 'Order-' . $randomNumber . $date;
    }
    public function deleteOrderGHN($order_code)
    {
        $response = Http::withHeaders([
            'Token' => env('TOKEN_GHN'),
            'ShopId' => env('SHOP_ID')
        ])->post('https://dev-online-gateway.ghn.vn/shiip/public-api/v2/switch-status/cancel', [
            'order_codes' => [
                $order_code
            ],
        ]);

        if (!$response->successful()) {
            Log::error('Cancel Order Fail: ' . $response->body());
        }
    }
}
