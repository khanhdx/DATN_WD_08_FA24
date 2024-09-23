<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    // Các thuộc tính có thể được gán
    protected $fillable = [
        'image',      // Đường dẫn ảnh
        'title',      // Tiêu đề bài viết
        'content',    // Nội dung bài viết
        'author',     // Tác giả bài viết
        'publish_date'// Ngày đăng
    ];

    // Nếu cần có các phương thức khác (ví dụ: để xử lý các mối quan hệ), có thể thêm vào đây.
}
