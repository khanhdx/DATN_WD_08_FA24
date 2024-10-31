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
        $product_price = Product::pluck('price_regular', 'id')->toArray();
        $color_id = Color::pluck('id')->toArray();
        $size_id = Size::pluck('id')->toArray();

        foreach ($product_id as $product) {
            foreach ($color_id as $color) {
                foreach ($size_id as $size) {
                    $price = $product_price[$product] * 0.6;
                    ProductVariant::create([
                        'product_id' => $product,
                        'color_id' => $color,
                        'size_id' => $size,
                        'stock' => rand(0, 100),
                        'price' => $price
                    ]);
                }
            }
        }
    }
}
