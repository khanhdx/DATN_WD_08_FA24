<?php

namespace App\Services\Order;

use App\Repositories\OrderRepository;

class OrderService implements IOrderService {

    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    
    public function getAll(){
        return $this->orderRepository->getAll();
    }

    public function getOneById($id){
        return $this->orderRepository->getOneById($id);
    }

    public function store($data, $id,){

    }

    public function update($data, $id){

    }

    public function destroy($id){

    }

    public function search($keyword){

    }

    public function updateStatus($data, $id)
    {
        $newStatus = $data;
        
        $order = $this->getOneById($id);

        // Cập nhật trạng thái ở bảng trung gian status_order_detail

          

            return redirect()->back()->with('success', 'Cập nhật trạng thái thành công');
    
    }
}