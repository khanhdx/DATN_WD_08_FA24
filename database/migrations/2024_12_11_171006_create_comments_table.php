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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('post_id'); // ID bài viết 
            $table->text('content');
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
            $table->boolean('is_approved')->default(false); // Trạng thái duyệt bình luận
            $table->string('status')->default('pending'); // Thêm cột 'status' với giá trị mặc định là 'pending'
            $table->timestamps();

            // Ràng buộc khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
