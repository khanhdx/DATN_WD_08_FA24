<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\StatusOrderDetail;
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
    $phone = $request->input('phone'); // Lọc theo số điện thoại

    // Kiểm tra các điều kiện lọc
    if ($status == 'all') {
        if ($phone) {
            // Lọc chỉ theo số điện thoại
            $data = $this->orderService->getByPhoneNumber($phone);
        } elseif ($date) {
            // Lọc chỉ theo ngày đặt
            $data = $this->orderService->getByDate($date);
        } else {
            // Lấy tất cả đơn hàng nếu không có bộ lọc
            $data = $this->orderService->getAll();
        }
    } else {
        if ($phone) {
            // Lọc theo trạng thái và số điện thoại
            $data = $this->orderService->getByStatusAndPhoneNumber($status, $phone);
        } elseif ($date) {
            // Lọc theo trạng thái và ngày đặt
            $data = $this->orderService->getByStatusAndDate($status, $date);
        } else {
            // Lọc chỉ theo trạng thái
            $data = $this->orderService->getByStatus($status);
        }
    }

    // Dữ liệu trả về từ dịch vụ
    $orders = $data[0];
    $countOrderByStatus = $data[1];
    $totalOrder = $data[2];

    // Lấy danh sách trạng thái
    $statuses = $this->statusService->getAll();

    // Trả về view với dữ liệu
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
            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function confirmProcessing($id)
    {
        $order = $this->orderService->getOneById($id);
        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại');
        }
        try {
            StatusOrderDetail::where('order_id', $id)->update(['status_order_id' => 2]);
            return  redirect()->back()->with('success', "Đơn hàng mã " . $order->slug . " đã xác nhận thành công.");
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', "Đơn hàng mã" . $order->slug  . " đã xác nhận thát bại. Hãy thử lại!!");
        }
    }
}
