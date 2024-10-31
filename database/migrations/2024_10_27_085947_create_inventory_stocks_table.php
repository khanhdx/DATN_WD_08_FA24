<?php

use App\Models\InventoryStock;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.     
     */
    public function up(): void
    {
        Schema::create('inventory_stocks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained();
            $table->foreignIdFor(ProductVariant::class)->nullable()->constrained();
            $table->integer('stock_change');                              // Số lượng thay đổi
            $table->string('type')                                        // Loại thay đổi
                  ->comment('import: Nhập hàng, export: Xuất hàng, adjustment: Chỉnh sửa tồn kho, return: Trả hàng');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_stocks');
    }
};
