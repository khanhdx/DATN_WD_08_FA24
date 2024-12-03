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
        'order_code',
        'shipping_fee',
        'total_price',
        'date',
        'user_name',
        'email',
        'phone_number',
        'address',
        'note'
    ];

    // Quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với trạng thái đơn hàng thông qua bảng status_order_details
    public function statusOrder()
    {
        return $this->belongsToMany(StatusOrder::class, 'status_order_details', 'order_id', 'status_order_id')
            ->withPivot('name', 'updated_at')
            ->withTimestamps();
    }

    public function statusOrderDetails()
    {
        return $this->hasMany(StatusOrderDetail::class, 'order_id');
    }

    // Quan hệ với shipper
    public function shipper()
    {
        return $this->belongsTo(Shipper::class);
    }

    // Quan hệ với chi tiết đơn hàng
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // Quan hệ với thanh toán
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    // Quan hệ với hoàn tiền
    public function refunds()
    {
        return $this->hasMany(Refund::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function voucherWare()
    {
        return $this->hasOne(VoucherWare::class, 'order_id', 'id');
    }
}
