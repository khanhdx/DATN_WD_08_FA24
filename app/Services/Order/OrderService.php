<?php

namespace App\Services\Order;

use App\Models\StatusOrderDetail;
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

        return $orders;
    }

    public function getOneById($id)
    {
        return $this->orderRepository->getOneById($id);
    }

    public function getByDate($date)
    {
        $orders = $this->orderRepository->getByDate($date);
     
        return $orders;
    }

    public function getByStatusAndDate($status, $date)
    {
        $orders = $this->orderRepository->getByStatusAndDate($status, $date);
      
        return $orders;
    }

    public function getByPhoneNumber($phone)
    {
        // Filter orders based on the user's phone number
        $orders = $this->orderRepository->getByPhoneNumber($phone);
    
        return $orders;
    }

    public function getByStatusAndPhoneNumber($status, $phone)
    {
        $orders = $this->orderRepository->getByStatusAndPhoneNumber($status, $phone);
        return $orders;
    }


    public function filter($status, $date, $phone) {

        if ($status == 'all') {
            if ($phone) {
                // Lọc chỉ theo số điện thoại
                $orders = $this->getByPhoneNumber($phone);
            } elseif ($date) {
     
                $orders = $this->getByDate($date);
            } else {
                // Lấy tất cả đơn hàng nếu không có bộ lọc
                $orders = $this->getAll();
            }
        } else {
            if ($phone) {
                // Lọc theo trạng thái và số điện thoại
                $orders = $this->getByStatusAndPhoneNumber($status, $phone);
            } elseif ($date) {
                // Lọc theo trạng thái và ngày đặt
                $orders = $this->getByStatusAndDate($status, $date);
            } else {
                // Lọc chỉ theo trạng thái
                $orders = $this->getByStatus($status);
            }
        }

        $countOrderByStatus = $this->statistical->countOrderGroupByStatus();
        $totalOrder = $this->statistical->totalOrder();

        return [$orders, $countOrderByStatus, $totalOrder];
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
                ->update(['status_order_id' => $data, 'updated_at' => now()]);
        }
    }
}
