<?php

namespace App\Services\Order;

interface IOrderService
{

    public function getAll();
    public function getByStatus($status);
    public function getOneById($id);
    public function getByDate($date);
    public function getByStatusAndDate($status, $date);
    public function getByPhoneNumber($phone);
    public function getByStatusAndPhoneNumber($status, $phone);
    public function filter($status, $date, $phone);
    public function store($data, $id,);

    public function update($data, $id);

    public function destroy($id);

    public function search($keyword);

    public function updateStatus($data, $id);
}
