<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class
        ]);
        
        for ($i=0; $i < 10; $i++) { 
            Post::create([
                'image'         => fake()->imageUrl,                    // Đường dẫn ảnh
                'title'         => fake()->text(25),        // Tiêu đề bài viết
                'content'       => fake()->text(500),       // Nội dung bài viết
                'author'        => fake()->name(),                      // Tác giả bài viết
                'publish_date'  => date('Y/m/d'),               // Ngày đăng
            ]);
        }
    }
}
