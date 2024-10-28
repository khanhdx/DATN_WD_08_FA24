<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'duc',
                'email' => 'duc@gmail.com',
                'phone_number' => '012345678',
                'password' => 'duc@gmail.com',
                'role' => 'Khách hàng',
            ],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '012345678',
                'password' => 'admin@gmail.com',
                'role' => 'Quản lý',
            ]
        ];
        foreach ($data as $key => $value) {
            User::query()->create($value);
        }
    }
}
