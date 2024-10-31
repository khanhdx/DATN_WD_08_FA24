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
        //
        $data = [
            [
                'name' => 'Admin123',
                'email' => 'admin123@gmail.com',
                'phone_number' => '012345678',
                'password' => bcrypt('Admin12345'),
                'role' => 'Quản lý',
            ],
            [
                'name' => 'user12345',
                'email' => 'user123@gmail.com',
                'phone_number' => '012345678',
                'password' => bcrypt('abcd12345'),
                'role' => 'Khách hàng',
            ]

        ];

        foreach ($data as $userData) {
            User::query()->create($userData);
        }
      
    }
}
