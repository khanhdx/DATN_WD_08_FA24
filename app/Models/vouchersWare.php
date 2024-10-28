<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vouchersWare extends Model
{
    use HasFactory;
    
    protected $table = "vouchers_wares";
    protected $fillable = [
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function wares_list()
    {
        return $this->hasMany(waresList::class, 'vouchers_ware_id');
    }
}
