<?php

use App\Models\Order;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)
                ->constrained()
                ->onDelete('cascade'); // Tự động xóa khi Order bị xóa

            $table->foreignIdFor(Product::class)
                ->constrained()
                ->onDelete('cascade'); // Tự động xóa khi Product bị xóa

            $table->foreignIdFor(ProductVariant::class)
                ->constrained()
                ->onDelete('cascade'); // Tự động xóa khi ProductVariant bị xóa

            $table->string('name_product');
            $table->string('color')->nullable(); // Nullable để linh hoạt hơn
            $table->string('size')->nullable();  // Nullable để linh hoạt hơn
            $table->double('unit_price');
            $table->integer('quantity');
            $table->double('total_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
