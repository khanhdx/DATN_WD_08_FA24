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
        $type = ['Man', 'Woman'];
        
        for ($i=0; $i < 10; $i++) { 
            Category::create([
                'name' => fake()->text(rand(10, 30)),
                'type' => $type[array_rand($type)],
            ]);
        }
    }
}
