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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);//Tên mã giảm giá
            $table->string('voucher_code', 255);//Mã giảm giá
            $table->enum('value', ['Phần trăm', 'Cố định']);//Giá trị giảm
            $table->float('decreased_value',12,2);//Mức giảm
            $table->float('max_value',12,2)->nullable();//Mức giảm tối đa
            $table->integer('quanlity');//Số lượng mã
            $table->integer('remaini')->default(0);//Số lượng còn lại
            $table->float('condition',12,2);//Điều kiện sử dụng (cho đơn hàng có mức giá tối thiểu)
            $table->date('date_start');//ngày bắt đầu
            $table->date('date_end');//Ngày kết thúc
            $table->enum('type_code', ['Cá nhân', 'Công khai']);
            $table->enum('status',['Chưa diễn ra', 'Đang diễn ra', 'Đã ngừng', 'Hết hàng']);
            $table->string('description')->nullable();
            $table->timestamps();//Ngày tạo
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
