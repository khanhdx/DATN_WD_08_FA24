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

    public function show(string $id) {
        // Truy vấn đơn hàng cùng với các mối quan hệ cần thiết
        $order = Order::with([
            'user', 
            'orderDetails.product', 
            'orderDetails.variant.color', // Màu sắc từ ProductVariant
            'orderDetails.variant.size',  // Kích thước từ ProductVariant
            'statuses', 
            'payments'
        ])->findOrFail($id);
    
        // Lấy thông tin chi tiết đơn hàng
        $orderDetails = $order->orderDetails;
    
        // Kiểm tra dữ liệu
        // dd($order);
    
        return view('admin.orders.show', compact('order', 'orderDetails'));
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
