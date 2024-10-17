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
        $orders = $this->orderService->getAll();
        $statuses = $this->statusService->getAll();

    
        return view('admin.orders.index', compact('orders', ['statuses']));
    }

    public function updateStatus(Request $request, $id)
    {
        $this->orderService->updateStatus($request->input('status_order'), $id);

        return redirect()->route('admin.orders.index');
    }
}
