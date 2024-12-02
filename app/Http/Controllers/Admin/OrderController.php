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

        // Gọi phương thức lấy đơn hàng dựa vào trạng thái và ngày
        if ($status == 'all') {
            $data = $this->orderService->getByDate($date);
        } else {
            $data = $this->orderService->getByStatusAndDate($status, $date);
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

        if($currentStatusId == 3 && $newStatusId == 5){
            return redirect()->back()->with('error', 'Đơn hàng đang giao. Không thể cập nhật trạng thái');
        }

        if($currentStatusId == 4 && $newStatusId == 5){
            return redirect()->back()->with('error', 'Đơn hàng đã giao thành công. Không thể cập nhật trạng thái');
        }
        

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
