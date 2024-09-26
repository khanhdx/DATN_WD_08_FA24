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
            Product::create([
                'category_id'   => rand(1, 10),
                'name'          => fake()->text(20),
                'SKU'           => "OB" . rand(10000,99999),
                'price_regular' => rand(100,999),
                'price_sale'    => rand(10,99),
                'description'   => fake()->text(200),
                'views'         => rand(1,100),
                'content'       => fake()->text(500),
            ]);
        }
    }
}
