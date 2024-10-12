<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'variant_id',
        'name_product',
        'color',
        'size',
        'unit_price',
        'quantity',
        'total_price',
        'note',
    ];

    public function order()
    {
        $this->belongsTo(Order::class);
    }
}
