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

    // Phương thức này trả về màu sắc dựa trên ID trạng thái
    // public function getColorAttribute()
    // {
    //     switch ($this->id) {
    //         case '1':
    //             return 'Chờ xử lý';
    //         case '2':
    //             return 'Đang xử lý';
    //         case '3':
    //             return 'Đang giao hàng';   
    //         case '4':
    //             return 'Giao hàng thành công';
    //         case '5':
    //             return 'Hủy đơn';   
    //         case '6':
    //             return 'Đã hủy';  
    //         case '7':
    //             return 'Đã hủy đơn';
    //     }
    // }


    // // Accessor để hiển thị trạng thái dưới dạng tiếng Việt
    public function getStatusLabelAttribute()
    {
        switch ($this->name_status) {
            case 'pending':
                return 'Chờ xử lý';
            case 'processing':
                return 'Đang lấy hàng';
            case 'picked':
                return 'Đã lấy hàng';
            case 'delivering':
                return 'Đang giao';
            case 'success':
                return 'Giao thành công';
            case 'failed':
                return 'Giao thất bại';
            case 'completed':
                    return 'Hoàn thành';
            case 'cancel':
                return 'Hủy đơn';
            case 'canceling':
                return 'Chờ xác nhận hủy';
            case 'canceled':
                return 'Đã hủy';
            case 'refunding':
                return 'Đang hoàn trả';
            case 'refunded':
                return 'Đã hoàn trả';
        }
    }

    // Quan hệ với bảng status_order_details
    public function statusOrderDetails()
    {
        return $this->hasMany(StatusOrderDetail::class, 'status_order_id');
    }

    // Quan hệ với bảng orders thông qua status_order_details
    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class, 'status_order_details', 'status_order_id', 'order_id')
    //                 ->withPivot('name', 'created_at', 'updated_at')
    //                 ->withTimestamps();
    // }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
