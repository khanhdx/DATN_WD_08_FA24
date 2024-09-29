<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";

    protected $fillable = [
        'category_id',
        'name',
        'avatar',
        // 'price_regular',
        // 'price_sale',
        'material',
        'short_desc',
        'content',
        'views',
        'import_date',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function variants()
    {
       return $this->hasMany(ProductVariant::class); 
    }
}
