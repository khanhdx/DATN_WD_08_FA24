<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function getAll()
    {
        $orders = Order::with(['statusOrder' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])->select('id', 'user_id', 'slug', 'total_price', 'created_at')->get();

        return $orders;
    }

    public function getByStatus($status)
    {
        $orders = Order::with(['statusOrder' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])->whereHas('statusOrder', function ($query) use ($status) {
            $query->where('name_status', $status);
        })->select('id', 'user_id', 'total_price', 'created_at')->get();

        return $orders;
    }

    public function getOneById($id)
    {
        $order = Order::findOrFail($id);

        return $order;
    }

    public function getByDate($date = null)
{
    $query = Order::with(['statusOrder' => function ($query) {
        $query->select('status_orders.id as id_status', 'name_status');
    }]);

    if ($date) {
        $query->whereDate('created_at', $date);
    }

    return $query->select('id', 'user_id', 'total_price', 'created_at')->get();
}

public function getByStatusAndDate($status, $date = null)
{
    $query = Order::with(['statusOrder' => function ($query) {
        $query->select('status_orders.id as id_status', 'name_status');
    }])->whereHas('statusOrder', function ($query) use ($status) {
        $query->where('name_status', $status);
    });

    if ($date) {
        $query->whereDate('created_at', $date);
    }

    return $query->select('id', 'user_id', 'total_price', 'created_at')->get();
}



    public function store($data) {}

    public function update() {}

    public function destroy() {}
}
