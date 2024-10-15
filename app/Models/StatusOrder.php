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

    public function getColorAttribute()
    {
        switch ($this->id) {
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

    // // Accessor để hiển thị trạng thái dưới dạng tiếng Việt
        public function getStatusLabelAttribute()
        {
            switch ($this->name_status) {
                case 'peding':
                    return 'Chờ xử lý';
                case 'processing':
                    return 'Đang xử lý';
                case 'shipping':
                    return 'Đang giao hàng';
                case 'completed':
                    return 'Giao hàng thành công';
                case 'cancel':
                    return 'Hủy đơn';
                case 'canceled':
                    return 'Đã hủy';
                case 'refund':
                    return 'Hoàn trả đơn';
                case 'refunded':
                    return 'Đã hoàn trả đơn';
            }
        }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'status_order_details', 'status_order_id', 'order_id')
            ->withPivot('name', 'updated_at')
            ->withTimestamps();
    }
}
