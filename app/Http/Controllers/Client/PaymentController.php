<?php

namespace App\Http\Controllers\Client;

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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        $cartId = auth()->check() ? Cart::where('user_id', auth()->id())->value('id') : Session::get('cart_id');

        if (!$cartId) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng không tồn tại.');
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
            'payment_method' => 'required|string',
        ]);

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

        $totalPrice = max($totalPrice, 0);

        try {
            $order = Order::create([
                'user_id' => auth()->id(),
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
