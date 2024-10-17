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
        'price',
    ];

    function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    function product_variant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
