<?php

namespace App\Services\Order\Status;

use App\Models\StatusOrder;

class StatusService {

    public function getAll()
    {
        $statuses = StatusOrder::select('id', 'name_status')->get();

        return $statuses;
    }

    
}