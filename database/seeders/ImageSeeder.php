<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productMan = Product::with(['category'])
        ->whereHas('category', function ($query) {
            $query->where('type', 'Man');
        })->get();

        $productWoman = Product::with(['category'])
        ->whereHas('category', function ($query) {
            $query->where('type', 'Woman');
        })->get();

        foreach ($productMan as $item) {
            ProductImage::create([
                'product_id' => $item->id,
                'image_url' => "products/Man/$item->name/main.jpeg",
                'type' => 'main'
            ]);
        }
        foreach ($productWoman as $item) {
            ProductImage::create([
                'product_id' => $item->id,
                'image_url' => "products/Woman/$item->name/main.jpeg",
                'type' => 'main'
            ]);
        }
    }
}
