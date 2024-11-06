<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\StatusOrder;
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
        // Lấy tham số lọc từ request
        $status = $request->input('status', 'all');
        $date = $request->input('date');
    
        // Gọi phương thức lấy đơn hàng dựa vào trạng thái và ngày
        if ($status == 'all') {
            $data = $this->orderService->getByDate($date);
        } else {
            $data = $this->orderService->getByStatusAndDate($status, $date);
        }
    
        $orders = $data[0];
        $countOrderByStatus = $data[1];
        $totalOrder = $data[2];
        $statuses = $this->statusService->getAll();
    
        return view('admin.orders.index', compact('orders', 'statuses', 'countOrderByStatus', 'totalOrder'));
    }
    
    public function show(string $id)
    {
        $order = Order::with([
            'user',
            'order_details',
            'order_details.product',
            'order_details.variant.color',
            'order_details.variant.size',
            'statusOrder',
            'payments'
        ])->findOrFail($id);

        $currentStatus = $order->statusOrder->last();
        $order_details = $order->order_details;

        return view('admin.orders.show', compact('order', 'order_details', 'currentStatus'));
    }

    public function updateStatus(Request $request, $id)
    {
        $newStatusId = $request->input('status_order');
        $order = $this->orderService->getOneById($id);
        $currentStatusId = $order->statusOrder->last()->id;


        if ($newStatusId < $currentStatusId) {
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái ngược lại.');
        }

        try {
            $this->orderService->updateStatus($newStatusId, $id);
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    public function destroy($id)
    {
        // Lấy đơn hàng theo ID
        $order = Order::findOrFail($id);
    
        // Kiểm tra xem đơn hàng có trạng thái 'canceled' không
        if ($order->statusOrder->contains('name_status', 'canceled')) {
            // Xóa các bản ghi liên quan trong bảng status_order_details
            $order->statusOrderDetails()->delete();
            // Xóa các bản ghi liên quan trong bảng payments
            $order->payments()->delete();
            // Xóa các chi tiết đơn hàng
            $order->orderDetails()->delete();
            // Xóa đơn hàng
            $order->delete();
        }
        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được xóa thành công.');
    }
    

}
