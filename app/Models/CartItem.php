<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $table = 'cart_items';

    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantity',
        'sub_total',
    ];

    // Định nghĩa quan hệ với ProductVariant
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    // Mối quan hệ với bảng Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Mối quan hệ với bảng Product thông qua ProductVariant
    public function product()
    {
        return $this->hasOneThrough(Product::class, ProductVariant::class, 'id', 'id', 'product_variant_id', 'product_id');
    }

    // Hàm để tính tổng giá trị của mục giỏ hàng
    public function totalPrice()
    {
        return $this->quantity * $this->productVariant->price; // Sử dụng giá từ ProductVariant
    }
}
