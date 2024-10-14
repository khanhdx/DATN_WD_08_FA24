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

    public function orders(){
       return $this->belongsToMany(Order::class, 'status_order_details', 'status_order_id', 'order_id')
                    ->withPivot('name', 'updated_at')
                    ->withTimestamps();
    }  

}
