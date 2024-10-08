<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shippers extends Model
{
    use HasFactory;
    protected $table = 'shippers';
    protected $fillable = [
        'name_shipper',
        'phone1',
        'phone2',
    ];
}
