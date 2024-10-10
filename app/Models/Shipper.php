<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    use HasFactory;
    protected $table = 'shippers';
    protected $fillable = [
        'name_shipper',
        'phone1',
        'phone2'
    ];
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function products(){
        return $this->hasMany(Product::class);
    }
    
}
