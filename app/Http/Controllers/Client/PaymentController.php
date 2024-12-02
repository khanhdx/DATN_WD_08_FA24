<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderEvent;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\StatusOrderDetail;
use App\Models\Voucher;
use App\Models\VoucherWare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

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

    public function processVoucher(Request $request)
    {
        $request->validate([
            'voucher_code' => 'required|string',
        ]);

        $voucher = Voucher::where('voucher_code', $request->voucher_code)->first();

        if ($request->action === 'apply') {
            if ($voucher) {
                $voucherUsed = VoucherWare::where('user_id', auth()->id())
                    ->where('voucher_id', $voucher->id)
                    ->exists();

                if ($voucherUsed) {
                    return redirect()->route('checkout')->with('error', 'Bạn đã sử dụng mã giảm giá này trước đây.');
                }

                if ($voucher->status === 'Đang diễn ra' && $voucher->date_start <= now() && $voucher->date_end >= now()) {
                    session(['voucher_id' => $voucher->id, 'discount' => $voucher->decreased_value]);

                    return redirect()->route('checkout')->with('success', 'Mã giảm giá đã được áp dụng!');
                }
                return redirect()->route('checkout')->with('error', 'Mã giảm giá không hợp lệ hoặc đã hết hạn.');
            }

            return redirect()->route('checkout')->with('error', 'Mã giảm giá không hợp lệ.');
        }

        if ($request->action === 'cancel') {
            if (!$voucher) {
                return redirect()->route('checkout')->with('error', 'Mã giảm giá không hợp lệ.');
            }

            $isUsed = Order::where('voucher_id', $voucher->id)->exists();
            if ($isUsed) {
                return redirect()->route('checkout')->with('error', 'Voucher đã được sử dụng và không thể hủy.');
            }

            $voucher->quanlity += 1;
            $voucher->save();

            session()->forget('voucher_id');
            session()->forget('discount');

            return redirect()->route('checkout')->with('success', 'Voucher đã được hủy thành công!');
        }

        return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra.');
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

        $voucherDiscount = session('discount', 0);
        $totalPrice -= $voucherDiscount;
        // $totalPrice += $request->ship_fee;

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
                'to_name' => $request->last_name,
                'to_phone' => $request->phone,
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

            if ($response->successful()) {
                $data = $response->json();
                $order_code = data_get($response, 'data.order_code', 'Không có mã đơn hàng');

            } else {
                // Xử lý lỗi API
                Log::error('API GHN Error: ' . $response->body());
                return redirect()->route('checkout')->with('error', $response->body());
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_code' => $order_code,
                'shipping_fee' => $request->ship_fee,
                'slug' => $this->generateSlug(),
                'total_price' => $totalPrice,
                'voucher_id' => session('voucher_id'),
                'status_order_id' => 1,
                'date' => now(),
                'address' => $request->address,
            ]);

            foreach ($cartItems as $item) {
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
            }

            StatusOrderDetail::create([
                'status_order_id' => 1,
                'order_id' => $order->id,
                'name' => '',
            ]);

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
            return redirect()->route('checkout')->with('error', 'Có lỗi xảy ra khi lưu đơn hàng. Vui lòng thử lại.');
        }

        $voucherId = session('voucher_id');
        if ($voucherId) {
            $voucher = Voucher::find($voucherId);
            if ($voucher && $voucher->quanlity > 0) {
                $voucher->quanlity -= 1;
                $voucher->save();

                VoucherWare::create([
                    'user_id' => auth()->id(),
                    'voucher_id' => $voucher->id,
                    'order_id' => $order->id,
                ]);
            }
        }

        CartItem::where('cart_id', $cartId)->delete();
        session()->forget('voucher_id');
        session()->forget('discount');

        return redirect()->route('payment.success')->with('success', 'Đặt hàng thành công!');
    }

    protected function generateSlug()
    {
        $randomNumber = rand(1000, 9999);
        $date = now()->format('Ymd');
        return 'Order-' . $randomNumber . $date;
    }
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ));
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
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
        $redirectUrl = route('checkout.process');
        $ipnUrl = route('checkout.process');
        $extraData = "";

        $requestId = time();
        $requestType = "captureWallet";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $jsonResult = json_decode($result, true);

        if ($jsonResult['resultCode'] == 0) {
            return redirect($jsonResult['payUrl']);
        } else {
            return redirect()->route('checkout')->with('error', 'Lỗi khi xử lý thanh toán MoMo.');
        }
    }

    public function paymentSuccess()
    {
        if (auth()->check()) {
            $orders = Order::where('user_id', auth()->id())->latest()->first();
            if (!$orders) {
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }
            return view('client.checkouts.success', compact('orders'));
        } else {
            if (!session()->has('order')) {
                return redirect()->route('home')->with('error', 'Bạn chưa đặt hàng.');
            }
            $orders = session('order');
            return view('client.checkouts.success', compact('orders'));
        }
    }
}
