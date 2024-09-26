<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    use HasFactory;
    protected $table = "locations";
    protected $fillable = [
        'user_id',
        'location_name',
        'phone_number',
        'user_name',
        'location_detail',
        'status',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
}
