<?php 

namespace App\Services\Statistical;

use App\Models\Order;

class StatisticalService {

    public function getRevenueByDay()
    {
        $revenues = Order::selectRaw('HOUR(created_at) as hour, SUM(total_price)')
                        ->whereDate('created_at', today())
                        ->groupBy('hour')
                        ->get();
        return $revenues;
    }

    public function getRevenue()
    {
        
    }
}