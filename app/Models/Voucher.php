<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Voucher extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'vouchers';
    protected $fillable = [
        'name',
        'voucher_code',
        'value',
        'decreased_value',
        'max_value',
        'quanlity',
        'remaini',
        'condition',
        'date_start',
        'date_end',
        'type_code',
        'status',
        'description',
    ]; 
}
