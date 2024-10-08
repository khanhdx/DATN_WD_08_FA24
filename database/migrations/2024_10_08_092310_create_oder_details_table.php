<?php

use App\Models\Oders;
use App\Models\Product;
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
        Schema::create('oder_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Oders::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
            $table->double('unitprice');
            $table->unsignedBigInteger('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oder_details');
    }
};
