<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class BillController extends Controller
{
    //
    public function showSearchPage()
    {
        return view('client.home.searchBill');
    }
    public function searchBill(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|digits_between:10,11', // Đảm bảo nhập đúng định dạng số điện thoại
        ]);

        // Tìm kiếm hóa đơn trong bảng `orders` theo số điện thoại
        $orders = Order::where('phone_number', $request->input('phone_number'))->get();

        if ($orders->isEmpty()) {
            return redirect()->back()->with('error', 'Không tìm thấy hóa đơn nào với số điện thoại này!');
        }

        return view('client.home.listBill', compact('orders'));
    }
    public function showBill($orderId)
    {
        // Lấy đơn hàng từ cơ sở dữ liệu
        $order = Order::with(['order_details', 'payments', 'statusOrder', 'voucherWare.voucher'])
            ->where('id', $orderId)
            ->firstOrFail();

        // Kiểm tra xem đơn hàng có tồn tại không
        if (!$order) {
            return redirect()->route('search.bill')->with('error', 'Không tìm thấy đơn hàng.');
        }

        // Trả về view với thông tin đơn hàng
        return view('client.home.showBill', compact('order'));
    }
}
