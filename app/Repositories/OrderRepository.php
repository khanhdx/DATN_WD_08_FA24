<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function getAll()
    {
        $orders = Order::with([
            'statusOrder' => function ($query) {
                $query->select('status_orders.id as id_status', 'name_status');
            }
        ])->select('id', 'order_code', 'user_id', 'slug', 'total_price', 'user_name', 'email', 'phone_number', 'address', 'created_at')
        ->orderBy('created_at', 'desc') 
        ->paginate(10);

        return $orders;
    }

    public function getByStatus($status)
    {
        $orders = Order::with(['statusOrder' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])
        ->whereHas('statusOrder', function ($query) use ($status) {
            $query->where('name_status', $status);
        })->select('id', 'order_code', 'user_id', 'slug', 'total_price', 'user_name', 'email', 'phone_number', 'address', 'created_at')
        ->orderBy('created_at', 'desc') 
        ->paginate(10);

        return $orders;
    }
    
    public function getByDate($date = null)
    {
        $query = Order::with(['statusOrder' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }]);
        if ($date) {
            $query->whereDate('created_at', $date);
        }
        return $query->select('id', 'order_code', 'user_id', 'slug', 'total_price', 'user_name', 'email', 'phone_number', 'address', 'created_at')
        ->orderBy('created_at', 'desc') 
        ->paginate(10);
    }

    public function getByStatusAndDate($status, $date = null)
    {
        $query = Order::with(['statusOrder' => function ($query) {
                $query->select('status_orders.id as id_status', 'name_status');}]
            )->whereHas('statusOrder', function ($query) use ($status) {
                $query->where('name_status', $status);
        });

        if ($date) {
            $query->whereDate('created_at', $date);
        }

        return $query
            ->select('id', 'order_code', 'slug', 'user_id', 'user_name', 'phone_number', 'total_price', 'created_at')
            ->orderBy('created_at', 'desc') 
            ->paginate(10);
    }

    public function getByPhoneNumber($phone)
    {
        $orders = Order::with(['statusOrder' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])
            ->where('phone_number', 'like', '%' . $phone . '%')
            ->select('id', 'order_code', 'slug', 'user_id', 'user_name', 'phone_number', 'total_price', 'created_at')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return $orders;
    }

    public function getByStatusAndPhoneNumber($status, $phone)
    {
        $orders = Order::with(['statusOrder' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])
            ->whereHas('statusOrder', function ($query) use ($status) {
                $query->where('name_status', $status);})
            ->select('id', 'order_code', 'user_id', 'slug', 'total_price', 'user_name', 'email', 'phone_number', 'address', 'created_at')
            ->where('phone_number', 'like', '%' . $phone . '%')
            ->paginate(10);

        return $orders;
    }

    public function getOneById($id)
    {
        $order = Order::findOrFail($id);

        return $order;
    }

    public function store($data) {}

    public function update() {}

    public function destroy() {}
}
