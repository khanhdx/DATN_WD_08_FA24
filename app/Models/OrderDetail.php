<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_variant_id',
        'name_product',
        'color',
        'size',
        'unit_price',
        'quantity',
        'total_price'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function statusOrder()
    {
        return $this->belongsTo(StatusOrder::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_details', 'order_id', 'product_id')
                    ->withPivot('quantity', 'unit_price', 'total_price');
    }
}
