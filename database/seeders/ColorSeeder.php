<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['name' => 'Red', 'code' => '#FF0000'],
            ['name' => 'Green', 'code' => '#00FF00'],
            ['name' => 'Blue', 'code' => '#0000FF'],
            ['name' => 'Yellow', 'code' => '#FFFF00'],
            ['name' => 'Cyan', 'code' => '#00FFFF'],
            ['name' => 'Magenta', 'code' => '#FF00FF'],
            ['name' => 'Black', 'code' => '#000000'],
            ['name' => 'White', 'code' => '#FFFFFF'],
            ['name' => 'Orange', 'code' => '#FFA500'],
            ['name' => 'Purple', 'code' => '#800080'],
        ];

        foreach ($colors as $item) {
            Color::create([
                'name'          => $item['name'],
                'code_color'    => $item['code']
            ]);
        }
    }
}
