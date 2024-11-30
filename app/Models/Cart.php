<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';
    protected $fillable = [
        'user_id'
    ];

    function cart_items(){
        return $this->hasMany(CartItem::class);
    }
    public function product() {
        return $this->belongsTo(Product::class);
    }
    
    public function color() {
        return $this->belongsTo(Color::class);
    }
    
    public function size() {
        return $this->belongsTo(Size::class);
    }
    
}
