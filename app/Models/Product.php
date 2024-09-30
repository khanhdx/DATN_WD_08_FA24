<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'SKU',
        'price_regular',
        'price_sale',
        'description',
        'views',
        'content',
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
       return $this->hasMany(ProductVariant::class); 
    }
}
