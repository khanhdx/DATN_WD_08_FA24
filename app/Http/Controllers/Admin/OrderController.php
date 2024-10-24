<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\Order\IOrderService;
use App\Services\Order\Status\StatusService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    protected $statusService;

    public function __construct(IOrderService $iOrderService, StatusService $statusService)
    {
        $this->orderService = $iOrderService;
        $this->statusService = $statusService;
    }

    public function index(Request $request)
    {
        // Xử lý hiện theo trạng thái khác nhau 
        $status = $request->input('status', 'all');

        if ($status == 'all') {
            $data = $this->orderService->getAll();
        } else {
            $data = $this->orderService->getByStatus($status);
        }

        // dd($data[0]);

        $orders = $data[0];
        $countOrderByStatus = $data[1];
        $totalOrder = $data[2];
        $statuses = $this->statusService->getAll();


        return view('admin.orders.index', compact('orders', ['statuses', 'countOrderByStatus', 'totalOrder']));
    }

    public function show(string $id)
{
    // Truy vấn đơn hàng cùng với các mối quan hệ cần thiết
    $order = Order::with([
        'user',                        // Quan hệ với User
        'order_details',                // Quan hệ với OrderDetail
        'order_details.product',        // Quan hệ với Product trong OrderDetail
        'order_details.variant.color',  // Màu sắc từ ProductVariant
        'order_details.variant.size',   // Kích thước từ ProductVariant
        'statusOrder',                    // Quan hệ với StatusOrder qua bảng trung gian
        'payments'                     // Quan hệ với Payment
    ])->findOrFail($id);

    $currentStatus = $order->statusOrder->last(); 
    // Lấy các chi tiết đơn hàng từ quan hệ orderDetails
    $order_details = $order->order_details;

    // Trả về view với dữ liệu đơn hàng và chi tiết đơn hàng
    return view('admin.orders.show', compact('order', 'order_details', 'currentStatus'));
}

    public function updateStatus(Request $request, $id)
    {

        try {
            $this->orderService->updateStatus($request->input('status_order'), $id);

            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }
}
