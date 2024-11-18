<?php

namespace Database\Seeders;

use App\Models\StatusOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mảng chứa các trạng thái đơn hàng
        $statuses = [
            ['name_status' => 'pending'],
            ['name_status' => 'processing'],
            ['name_status' => 'shipping'],
            ['name_status' => 'completed'],
            ['name_status' => 'cancel'],
            ['name_status' => 'canceled'],
            ['name_status' => 'refunding'],
            ['name_status' => 'refunded'],
        ];

        // Lặp qua mảng và tạo bản ghi trong bảng status_orders
        foreach ($statuses as $status) {
            StatusOrder::create($status);
        }
    }
}
