<?php

namespace App\Services\Order;

use App\Repositories\OrderRepository;
use App\Services\Statistical\StatisticalService;
use Illuminate\Support\Facades\DB;

class OrderService implements IOrderService
{

    protected $orderRepository;

    protected $statistical;

    public function __construct(OrderRepository $orderRepository, StatisticalService $statisticalService)
    {
        $this->orderRepository = $orderRepository;
        $this->statistical = $statisticalService;
    }

    public function getAll()
    {
        $orders = $this->orderRepository->getAll();
        $countOrderByStatus = $this->statistical->countOrderGroupByStatus();
        $totalOrder = $this->statistical->totalOrder();

        return [$orders, $countOrderByStatus, $totalOrder];
    }

    public function getByStatus($status)
    {
        $orders = $this->orderRepository->getByStatus($status);
        $countOrderByStatus = $this->statistical->countOrderGroupByStatus();
        $totalOrder = $this->statistical->totalOrder();

        return [$orders, $countOrderByStatus, $totalOrder];
    }

    public function getOneById($id)
    {
        return $this->orderRepository->getOneById($id);
    }

    public function store($data, $id,) {}

    public function update($data, $id) {}

    public function destroy($id) {}

    public function search($keyword) {}

    public function updateStatus($data, $id)
    {
        // Kiểm tra order_id có tồn tại trong bảng trung gian ko 
        $orderExists = DB::table('status_order_details')->where('order_id', $id)->exists();

        if ($orderExists) {
            DB::table('status_order_details')
                ->where('order_id', $id)
                ->update(['status_order_id' => $data]);
        }
    }

   


}
