<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoucherWare extends Model
{
    use HasFactory;

    protected $table = 'vouchers_wares';
    
    protected $fillable = [
        'user_id',
        'voucher_id',
        'order_id',
    ];

    // Định nghĩa quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Định nghĩa quan hệ với Voucher
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
}
