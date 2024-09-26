<?php

namespace Database\Seeders;

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
        for ($i=0; $i < 10; $i++) {
            $price = rand(100,999);
            $sale = $price * 0.6; // Giảm 40%
            Product::create([
                'category_id'   => rand(1, 10),
                'name'          => fake()->text(20),
                'SKU'           => "OB" . rand(10000,99999),
                'price_regular' => $price,
                'price_sale'    => $sale,
                'description'   => fake()->text(200),
                'views'         => rand(1,100),
                'content'       => fake()->text(500),
            ]);
        }
    }
}
