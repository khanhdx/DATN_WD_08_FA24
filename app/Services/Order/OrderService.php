<?php

namespace App\Services\Order;

use App\Models\Order;
use App\Models\Payment;
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


    public function filter($status, $date, $phone)
    {
        $orders = Order::with(['statusOrder' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])
            ->when($status, function ($query, $status) {
                return $query->whereHas('statusOrder', function ($query) use ($status) {
                    $query->where('name_status', $status);
                });
            })
            ->when($date, function ($query, $date) {
                return $query->whereDate('created_at', $date);
            })
            ->when($phone, function ($query, $phone) {
                return $query->where('phone_number', 'like', '%' . $phone . '%');
            })
            ->select('id', 'order_code', 'user_id', 'slug', 'total_price', 'user_name', 'email', 'phone_number', 'address', 'created_at')
            ->orderByDesc('created_at')
            ->paginate(10)->appends([
                'status' => $status,
                'date' => $date,
                'phone' => $phone,
            ]);

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

            if ($data == 5) {
                DB::table('payments')
                    ->where('order_id', $id)
                    ->update(['status' => 1]);
            }
        }
    }
}
