<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $date = ['deleted_at'];
    protected $fillable = [
        'category_id',
        'image',
        'name',
        'SKU',
        'base_stock',
        'price_regular',
        'price_sale',
        'description',
        'views',
        'content',
    ];
    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
       return $this->hasOne(ProductImage::class)->where('type', 'main'); 
    }

    public function variants()
    {
       return $this->hasMany(ProductVariant::class); 
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_variants', 'product_id', 'size_id');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_variants', 'product_id', 'color_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
