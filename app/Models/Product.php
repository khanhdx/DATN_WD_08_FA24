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
