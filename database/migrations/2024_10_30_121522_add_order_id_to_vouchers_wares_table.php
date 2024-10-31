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
        Schema::table('vouchers_wares', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('order_id')->nullable()->after('voucher_id'); // Thêm cột order_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vouchers_wares', function (Blueprint $table) {
            //
            Schema::table('vouchers_wares', function (Blueprint $table) {
                $table->dropColumn('order_id'); // Xóa cột order_id khi rollback
            });
        });
    }
};
