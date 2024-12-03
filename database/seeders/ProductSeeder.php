<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sanPhamNam = [
            'Áo nam sơ mi trắng Obito',
            'Áo nam thun đen Obito',
            'Áo nam hoodie xám Obito',
            'Áo nam khoác da Obito',
            'Áo nam len cổ tròn Obito',
            'Quần nam jean xanh Obito',
            'Quần nam tây đen Obito',
            'Quần nam short kaki Obito',
            'Quần nam thể thao Obito',
            'Quần nam jean rách Obito',
            'Áo nam vest xanh Obito',
            'Áo nam polo xanh đậm Obito',
            'Quần nam kaki be Obito',
            'Áo nam thun cổ trụ Obito',
            'Quần nam jogger đen Obito',
        ];

        $sanPhamNu = [
            'Áo nữ sơ mi họa tiết Obito',
            'Áo nữ thun crop top Obito',
            'Áo nữ khoác gió Obito',
            'Áo nữ hoodie hồng Obito',
            'Áo nữ len cổ tim Obito',
            'Quần nữ jean skinny Obito',
            'Quần nữ short bò Obito',
            'Quần nữ váy caro Obito',
            'Quần nữ tây xám Obito',
            'Quần nữ legging Obito',
            'Áo nữ blouse trắng Obito',
            'Áo polo nữ Obito',
            'Quần kaki nữ Obito',
            'Áo nữ sát nách Obito',
            'Quần nữ baggy Obito',
        ];

        $categoryMan = Category::query()->where('type', "Man")->pluck('id', 'id')->toArray();

        foreach ($sanPhamNam as $key => $nam) {
            $price = rand(100, 9000);
            $sale = round($price * 0.6) * 1000; // Giảm 40%

            Product::create([
                'category_id'   => array_rand($categoryMan),
                'image'         => '/assets/client/images/content/products/product-' . rand(1, 8) . '.jpg',
                'name'          => $nam,
                'SKU'           => "OB" . Str::random(3) . "0000" . $key,
                'price_regular' => $price * 1000,
                'price_sale'    => $sale,
                'base_stock'    => rand(0, 500),
                'description'   => fake()->text(200),
                'views'         => rand(1, 100),
                'content'       => fake()->text(400),
            ]);
        }

        $categoryWoman = Category::query()->where('type', "Woman")->pluck('id', 'id')->toArray();

        foreach ($sanPhamNu as $key => $nu) {
            $price = rand(100, 9000);
            $sale = round($price * 0.5) * 1000;

            Product::create([
                'category_id'   => array_rand($categoryWoman),
                'image'         => '/assets/client/images/content/products/product-' . rand(9, 17) . '.jpg',
                'name'          => $nu,
                'SKU'           => "OB" . Str::random(3) . "0000" . $key,
                'price_regular' => $price * 1000,
                'price_sale'    => $sale,
                'base_stock'    => rand(0, 500),
                'description'   => fake()->text(200),
                'views'         => rand(1, 100),
                'content'       => fake()->text(400),
            ]);
        }
    }
}
