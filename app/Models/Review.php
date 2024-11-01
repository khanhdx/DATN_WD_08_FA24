<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews'; // Tên bảng trong cơ sở dữ liệu

    protected $fillable = [
        'user_id', // ID của người dùng
        'product_id', // ID sản phẩm
        'order_id', // ID đơn hàng
        'rating', // Điểm đánh giá
        'review', // Nội dung đánh giá
    ];

    // Quan hệ với người dùng
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Quan hệ với sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Quan hệ với đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
