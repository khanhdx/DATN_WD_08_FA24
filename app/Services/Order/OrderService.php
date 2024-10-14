<?php

namespace App\Services\Order;

use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\DB;

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

        // Kiểm tra order_id có tồn tại trong bảng trung gian ko 
       $orderExists = DB::table('status_order_details')->where('order_id', $id)->exists();

       if($orderExists){
            DB::table('status_order_details')
                ->where('order_id', $id)
                ->update(['status_order_id' => $data]);

            return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái thành công');
       } else {
        return redirect()->route('admins.orders.index')->with('failed', 'Cập nhật thất bại');
       } 
    
      
      
    }
}