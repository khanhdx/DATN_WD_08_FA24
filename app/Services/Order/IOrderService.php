<?php

namespace App\Services\Order;

interface IOrderService
{

    public function getAll();

    public function getByStatus($status);

    public function getOneById($id);

    public function store($data, $id,);

    public function update($data, $id);

    public function destroy($id);

    public function search($keyword);

    public function updateStatus($data, $id);
}
