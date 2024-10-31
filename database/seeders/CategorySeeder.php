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
            'Áo sơ mi',
            'Áo thun crop top',
            'Áo hoodie',
            'Áo khoác gió',
            'Áo len cổ tim',
            'Váy và Đầm',
            'Quần jean skinny',
            'Quần tây nữ',
            'Quần legging',
            'Quần váy',
        ];

        $man = [
            'Áo sơ mi',
            'Áo thun',
            'Áo khoác',
            'Áo len',
            'Áo polo',
            'Quần jean',
            'Quần tây',
            'Quần short',
            'Quần jogger',
            'Vest và Blazer',
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
