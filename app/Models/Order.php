<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'shipper_id',
        'total_price',
        'address',
        'note'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function statuses()
    {
        return $this->belongsToMany(StatusOrder::class, 'status_order_details', 'order_id', 'status_order_id')
            ->withPivot('name', 'updated_at')
            ->withTimestamps();
    }
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function payments()
    {
        $this->hasMany(Payment::class);
    }

    public function refunds()
    {
        $this->hasMany(Refund::class);
    }
}
