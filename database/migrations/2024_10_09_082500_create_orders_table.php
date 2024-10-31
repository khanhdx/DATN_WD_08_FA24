<?php

use App\Models\Shipper;
use App\Models\StatusOrder;
use App\Models\User;
use App\Models\Voucher;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignIdFor(User::class)->constrained();
            $table->foreignIdFor(Shipper::class)->constrained();
            $table->foreignIdFor(Voucher::class)->nullable()->constrained();
            $table->dateTime('date');
            $table->double('total_price');
            $table->string('address', 255);
            $table->string('note', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
