<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $size = ['S', 'M', 'L'];

        foreach ($size as $item) {
            Size::create([
                'name' => $item,
            ]);
        }
    }
}
