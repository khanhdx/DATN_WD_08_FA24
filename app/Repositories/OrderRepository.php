<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function getAll()
    {
        $orders = Order::with(['statuses' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])->select('id', 'user_id', 'total_price', 'created_at')->get();

        return $orders;
    }

    public function getByStatus($status)
    {
        $orders = Order::with(['statuses' => function ($query) {
            $query->select('status_orders.id as id_status', 'name_status');
        }])->whereHas('statuses', function ($query) use ($status) {
                $query->where('name_status', $status);
            })->select('id', 'user_id', 'total_price', 'created_at')->get();

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
