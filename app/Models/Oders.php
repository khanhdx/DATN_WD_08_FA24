<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oders extends Model
{
    use HasFactory;
    protected $table = 'oders';
    protected $fillable = [
        'id_user',
        'id_status',
        'id_shipper',
        'date',
        'total_price',
        'address',
        'note',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

    // public function status() {
    //     return $this->belongsTo(Status_oders::class);
    // }
    // public function shipper() {
    //     return $this->belongsTo(Shippers::class);
    // }
    // public function orderDetails() {
    //     return $this->hasMany(Oder_detail::class);
    // }
}
