<?php

use App\Models\Category;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Category::class)->constrained();

            $table->string('name');                         // Tên sản phẩm
            $table->string('image');                        // Ảnh sản phẩm
            $table->string('SKU')->unique();                // Mã SKU
            $table->decimal('price_regular');               // Giá thường
            $table->decimal('price_sale')->nullable();      // Giá sale
            $table->string('description')->nullable();      // Mô tả
            $table->integer('views')->default(0);    // Lượt xem
            $table->text('content')->nullable();            // Nội dung

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
