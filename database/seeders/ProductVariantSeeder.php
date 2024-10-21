<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_id = Product::pluck('id')->toArray();
        $color_id = Color::pluck('id')->toArray();
        $size_id = Size::pluck('id')->toArray();
// dd($product);

        for ($i = 0; $i < 10; $i++) {
            $product = $product_id[array_rand($product_id)];
            $color = $color_id[array_rand($color_id)];
            $size = $size_id[array_rand($size_id)];

            ProductVariant::create([
                'product_id' => $product,
                'color_id' => $color,
                'size_id' => $size,
                'stock' => rand(10, 100),
                'price' => rand(100, 999)
            ]);
        }
    }
}
