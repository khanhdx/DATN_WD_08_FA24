<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    use HasFactory;

    protected $appends = ['type_label'];

    protected $fillable = [
        'product_id',
        'product_variant_id',
        'stock_change',
        'type'
    ];

    public function getTypeLabelAttribute()
    {
        switch ($this->type) {
            case 'export':
                return 'Xuất hàng';
            case 'import':
                return 'Nhập hàng';
            case 'adjustment':
                return 'Chỉnh sửa tồn kho';
            case 'return':
                return 'Trả hàng';
        }
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
