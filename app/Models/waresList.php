<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class waresList extends Model
{
    use HasFactory;
    protected $table = 'wares_lists';
    protected $fillable = [
        'vouchers_ware_id',
        'voucher_id',
        'status',
    ];
    public function voucher()
    {
        return $this->belongsTo(Voucher::class);
    }
    public function vouchers_ware()
    {
        return $this->belongsTo(VoucherWare::class);
    }
}
