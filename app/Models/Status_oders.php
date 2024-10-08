<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status_oders extends Model
{
    use HasFactory;
    protected $table = 'status_oders';
    protected $fillable = [
        'name_status',
    ];

}
