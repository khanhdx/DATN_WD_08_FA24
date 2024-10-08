<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oder_detail extends Model
{
    use HasFactory;
    protected $table = 'oder_details';
    protected $fillable = [
        'id_oder',
        'id_product',
        'unitprice',
        'quantity',
    ];
    public function oder() {
        return $this->belongsTo(Oders::class);
    }
    
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
