<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusOrder extends Model
{
    use HasFactory;
    protected $table = 'status_orders';
    protected $fillable = [
        'name_status'
    ];

    public function getColorAttribute(){
        switch($this->id){
            case 1:
                return 'warning';
            case 2:
                return 'primary';
            case 3:
                return 'info';
            case 4:
                return 'success';
            default:
                return 'danger';
        }
    }

    public $timestamps = false;

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
