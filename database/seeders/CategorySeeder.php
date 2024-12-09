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
            'Áo nữ',
            'Quần nữ',
            'Set bộ nữ',
        ];

        $man = [
            'Áo nam',
            'Quần nam',
            'Set bộ nam',
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
