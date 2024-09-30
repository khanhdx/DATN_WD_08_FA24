<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề
            $table->text('content'); // Nội dung
            $table->string('author'); // Tác giả
            $table->string('image')->nullable(); // Đường dẫn ảnh (nullable)
            $table->date('publish_date')->nullable(); // Ngày đăng
            $table->timestamps(); // Thời gian tạo và cập nhật
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
