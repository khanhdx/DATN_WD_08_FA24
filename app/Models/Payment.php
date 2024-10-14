<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'transaction_type',
        'payment_method',
        'status',
        'note',
    ];


    public function order()
    {
        $this->belongsTo(Order::class);
    }
}
