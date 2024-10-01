<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $woman = [
            'Coats',
            'Outerwear',
            'Dresses',
            'Tops',
            'Trousers',
            'Shirts',
            'Jeans',
            'T-shirts',
            'Shoes',
            'Handbags',
            'Stock clearance',
        ];

        $man = [
            'Jackets',
            'Blazers',
            'Suits',
            'Trousers',
            'Jeans',
            'Shirts',
            'Sweatshirts & Hoodies',
            'Swimwear',
            'Accessories',
        ];

        foreach ($man as $item) {
            Category::create([
                'name' => $item,
                'type' => 'Man',
            ]);
        }
        
        foreach ($woman as $item) {
            Category::create([
                'name' => $item,
                'type' => 'Woman',
            ]);
        }

    }
}
