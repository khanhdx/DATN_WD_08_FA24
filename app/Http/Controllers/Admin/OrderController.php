<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
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

    public function index()
    {
        $data = $this->orderService->getAll();

        $orders = $data[0];
        $countOrderByStatus = $data[1];
        $totalOrder = $data[2];

        // dd($countOrderByStatus);

        $statuses = $this->statusService->getAll();

    
        return view('admin.orders.index', compact('orders', ['statuses', 'countOrderByStatus', 'totalOrder']));
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
