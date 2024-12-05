<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\CompleteOrderJob;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\StatusOrderDetail;
use App\Services\Inventory\InventoryService;
use App\Services\Order\IOrderService;
use App\Services\Order\Status\StatusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    protected $orderService;
    protected $statusService;

    protected $inventoryService;

    public function __construct(IOrderService $iOrderService, StatusService $statusService, InventoryService $inventoryService)
    {
        $this->orderService = $iOrderService;
        $this->statusService = $statusService;
        $this->inventoryService = $inventoryService;
    }

    public function index(Request $request)
{
    // Lấy tham số lọc từ request
    $status = $request->input('status', 'all');
    $date = $request->input('date');
    $phone = $request->input('phone');  // Lọc theo số điện thoại

    // Gọi phương thức lấy đơn hàng dựa vào trạng thái, ngày, và số điện thoại
    if ($status == 'all') {
        if ($phone) {
            $data = $this->orderService->getByPhoneNumber($phone);
        } else {
            $data = $this->orderService->getByDate($date);
        }
    } else {
        if ($phone) {
            $data = $this->orderService->getByStatusAndPhoneNumber($status, $phone);
        } else {
            $data = $this->orderService->getByStatusAndDate($status, $date);
        }
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
        $order = $this->orderService->getOneById($id);
        $currentStatusId = $request->status_order;
        $newStatusId = $currentStatusId + 1;
    
        if ($newStatusId < $currentStatusId) {
            return redirect()->back()->with('error', 'Không thể cập nhật trạng thái ngược lại.');
        }
    
        try {
            DB::transaction(function () use ($order, $newStatusId) {
                     $this->orderService->updateStatus($newStatusId, $order->id);
                    // Status Shipping
                     if($newStatusId == 3){
                        foreach ($order->order_details as $detail) {
                            $productVariantId = $detail->product_variant_id;
                            $productId = $detail->product_id;
                            $this->inventoryService->exportVariantStock($detail->quantity,  $productId , $productVariantId);
                        }
                     } else if ($newStatusId == 5 || $newStatusId == 7){ // Status Canceled && Refunded
                        foreach ($order->orderDetails as $detail) {
                            $productVariantId = $detail->product_variant_id;
                            $productId = $detail->product_id;
                            $this->inventoryService->importVariantStock($detail->quantity,  $productId , $productVariantId);
                     }}

                     if($newStatusId == 4 ){ // Status Success
                        CompleteOrderJob::dispatch($order->id)->delay(now()->addDays(7));
                     }
            }, 3);
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
