<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lấy tất cả các category_id từ bảng categories
        $categoryIds = Category::pluck('id')->toArray();
        
        $categoryType = Category::pluck('type', 'id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $price = rand(100, 999);
            $sale = round($price * 0.6, 2); // Giảm 40%
            $category = $categoryIds[array_rand($categoryIds)];
            $type = $categoryType[$category];

            Product::create([
                'category_id'   => $category, // Chọn ngẫu nhiên từ các category_id hợp lệ
                'image'         => '/assets/client/images/content/products/product-' . ( $type == "Man" ? rand(1, 8) : rand(9, 17) ) . '.jpg',
                'name'          => fake()->text(20),
                'SKU'           => "OB" . rand(10000, 99999),
                'price_regular' => $price,
                'price_sale'    => $sale,
                'description'   => fake()->text(200),
                'views'         => rand(1, 100),
                'content'       => fake()->text(500),
            ]);
        }
    }
}
