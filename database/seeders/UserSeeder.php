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
            'name'=> 'Admin123',
            'email'=> 'admin123@gmail.com',
            'phone_number'=> '012345678',
            'password'=> 'Admin123',
            'role'=>'Quản lý',
        ];
        User::query()->create($data);
    }
}
