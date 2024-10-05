<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('vouchers')->insert([
            [
                'name'=>'Tri ân khách hàng',
                'voucher_code'=>'TriAnKhachHang',
                'value'=>'Cố định',
                'decreased_value'=>'100000',
                'max_value'=>'100000',
                'quanlity'=>'1000',
                'condition'=>'0',
                'date_start'=>'2024-10-03 00:00:00',
                'date_end'=>'2024-10-03 23:59:59',
                'type_code'=>'Công khai',
                'status'=>'Đang diên ra',
                'description'=>'Tri ân khách hàng mới tham gia vào hệ thống.',
            ],
            [
                'name'=>'Khai trương của hàng',
                'voucher_code'=>'KhaiTruongCuaHang',
                'value'=>'Phần trăm',
                'decreased_value'=>'50',
                'max_value'=>'100000',
                'quanlity'=>'10',
                'condition'=>'500000',
                'date_start'=>today().' 00:00:00',
                'date_end'=>today().'23:59:59',
                'type_code'=>'Công khai',
                'status'=>'Đang diên ra',
                'description'=>'Khai trương cửa hàng 10 mã giảm giá cho khách hàng nhanh tay đặt hàng',
            ],

        ]);
    }
}
