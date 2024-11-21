<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            SizeSeeder::class,
            ColorSeeder::class,
            ProductVariantSeeder::class,
            PostSeeder::class,
            StatusOrderSeeder::class,
            UserSeeder::class,
            ChatRoomSeeder::class,
            VoucherSeeder::class,
        ]);
    }
}
