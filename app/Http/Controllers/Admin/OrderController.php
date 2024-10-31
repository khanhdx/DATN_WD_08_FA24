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
        return redirect()->back()->with('error','Không thể cập nhật trạng thái ngược lại.');
    }

    try {
        $this->orderService->updateStatus($newStatusId, $id);
        return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    } catch (\Throwable $th) {
        return redirect()->back()->withErrors($th->getMessage());
    }
}

}
