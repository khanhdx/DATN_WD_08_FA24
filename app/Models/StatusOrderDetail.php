<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrderDetail extends Model
{
    use HasFactory;
    protected $table = 'status_order_details';

    protected $fillable = [
        'status_order_id',
        'order_id',
        'name',
    ];

    // Thiết lập mối quan hệ với model StatusOrder
    public function statusOrder()
    {
        return $this->belongsTo(StatusOrder::class, 'status_order_id');
    }

    // Thiết lập mối quan hệ với model Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
