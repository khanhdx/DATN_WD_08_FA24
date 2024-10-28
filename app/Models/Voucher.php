<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'vouchers';
    protected $fillable = [
        'name',
        'voucher_code',
        'value',
        'decreased_value',
        'max_value',
        'quanlity',
        'condition',
        'date_start',
        'date_end',
        'type_code',
        'status',
        'description',
    ];
    public function wares_list()
    {
        return $this->hasMany(waresList::class, 'voucher_id');
    }
}
