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
        'shipper_id',
        'total_price',
        'date',
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
    // public function products()
    // {
    //     return $this->belongsToMany(Product::class)->withPivot('quantity');
    // }
    // Quan hệ với sản phẩm thông qua bảng trung gian
    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product') // Giả sử bảng trung gian là 'order_product'
            ->withPivot('quantity', 'price') // Thêm thông tin về số lượng và giá
            ->withTimestamps();
    }
    
}