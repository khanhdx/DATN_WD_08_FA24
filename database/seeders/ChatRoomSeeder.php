<?php

namespace Database\Seeders;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::pluck('id', 'id')->toArray();

        foreach ($users as $value) {
            ChatRoom::firstOrCreate([
                'id' => $value,
                'user_id' => $value,
            ]);
        }
    }
}
