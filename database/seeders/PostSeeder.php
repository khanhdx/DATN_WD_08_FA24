<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) {
            Post::create([
                'image'         => fake()->imageUrl,        // Đường dẫn ảnh
                'title'         => fake()->text(25),        // Tiêu đề bài viết
                'content'       => fake()->text(500),       // Nội dung bài viết
                'author'        => fake()->name(),          // Tác giả bài viết
                'publish_date'  => date('Y/m/d'),   // Ngày đăng
            ]);
        }
    }
}
