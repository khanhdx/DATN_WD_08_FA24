<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'slug',
        'user_id',
        'status_order_id',
        'shipper_id',
        'name',
        'phone',
        'total_price',
        'address',
        'note'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function status_order(){
        return $this->belongsTo(StatusOrder::class);
    }
    public function shipper(){
        return $this->belongsTo(Shipper::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }
}
