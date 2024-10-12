<?php

use App\Models\Order;
use App\Models\StatusOrder;
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
        Schema::create('status_order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StatusOrder::class)->constrained();   
            $table->foreignIdFor(Order::class)->constrained();
            $table->string('name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_order_details');
    }
};
