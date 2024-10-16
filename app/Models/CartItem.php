<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_variant_id',
        'quantily',
        'price',
    ];

    function cart(){
        $this->belongsTo(Cart::class);
    }
    function product_variant(){
        $this->belongsTo(ProductVariant::class);
    }
}
