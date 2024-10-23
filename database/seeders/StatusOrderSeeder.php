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
            ['name_status' => 'Chờ xử lý'],
            ['name_status' => 'Đang xử lý'],
            ['name_status' => 'Đang giao hàng'],
            ['name_status' => 'Giao hàng thành công'],
            ['name_status' => 'Hủy đơn'],
            ['name_status' => 'Đã hủy'],
            ['name_status' => 'Đã hủy đơn'],
        ];

        // Lặp qua mảng và tạo bản ghi trong bảng status_orders
        foreach ($statuses as $status) {
            StatusOrder::create($status);
        }
    }
}
