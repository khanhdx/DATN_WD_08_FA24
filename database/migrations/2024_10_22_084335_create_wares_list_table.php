<?php

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
        Schema::create('wares_list', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vouchers_ware_id')->constrained('vouchers_wares')->onDelete('cascade');
            $table->enum('status',["Đã sử dụng", "Chưa sử dụng"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wares_list');
    }
};
