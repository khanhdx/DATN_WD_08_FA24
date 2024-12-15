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
            'Áo tanktop Base Jack Lane',
            'Áo khoác dạ Brook Obito',
            'Áo khoác dạ Nino Jack Lane',
            'Áo khoác Varsity Box Obito',
            'Áo len cộc tay Grand Obito',
            'Áo len Simon Jack Lane',
            'Áo Jacket Denim Typo Obito',
            'Áo jacket len Oak Obito',
            'Áo Polo Oversize WONDER',
            'Áo polo cộc tay Knit Jack Lane',
            'Áo len sweater Ralz Obito',
            'Quần Jeans Typo Obito',
            'Quần nỉ oversize Wided Pants Obito',
            'Quần short Jeans lửng Jort Obito',
            'Quần short Light Obito',
            'Quần Short lửng Fiin Obito',
            'Quần dài Blackey Obito',
            'Quần Jeans Otis Obito',
            'Quần dài Noah Obito',
            'Set bộ Frank Obito',
        ];

        $sanPhamNu = [
            'Áo Cardigan Nỉ Henry Obito',
            'Áo Khoác Phao Obito - Form boxy',
            'Áo sơ mi cộc tay original Obito',
            'Áo sơ mi cộc tay Type Obito',
            'Áo sơ mi dài tay Original Obito',
            'Áo thun Blue heart Obito',
            'Áo thun Striped Flower Obito',
            'Quần dài kẻ sọc ống rộng Striped Obito',
            'Quần nỉ dài Relax Pants Obito',
            'Set bộ Genne Obito',
        ];

        foreach ($sanPhamNam as $key => $nam) {
            $price = rand(100, 900);
            $sale = round($price * 0.6) * 1000; // Giảm 40%

            Product::create([
                'category_id'   => Str::contains($nam, 'Áo') ? 1 : (Str::contains($nam, 'Quần') ? 2 : 3),
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

        // $categoryWoman = Category::query()->where('type', "Woman")->pluck('id', 'id')->toArray();

        foreach ($sanPhamNu as $key => $nu) {
            $price = rand(100, 900);
            $sale = round($price * 0.5) * 1000;

            Product::create([
                'category_id'   => Str::contains($nu, 'Áo') ? 4 : (Str::contains($nu, 'Quần') ? 5 : 6),
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
