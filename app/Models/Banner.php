<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable= ['title','image','status'];
    public function getStatusAttribute($value)
    {
        return $value == 1 ? 'Hiển thị' : 'Ẩn';
    }
}
