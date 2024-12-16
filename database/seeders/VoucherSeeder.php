<?php

namespace Database\Seeders;

use App\Models\Voucher;
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
        $datas = [
            [
                'name'=>'Tri ân khách hàng',
                'voucher_code'=>'TriAnKhachHang',
                'value'=>'Cố định',
                'decreased_value'=>'100000',
                'max_value'=>'100000',
                'quanlity'=>'1000',
                'remaini'=>'1000',
                'condition'=>'0',
                'date_start'=>Date("Y-m-d"),
                'date_end'=>'2025-10-03',
                'type_code'=>'Công khai', 
                'status'=>'Đang diên ra',
                'description'=>'Tri ân khách hàng mới tham gia vào hệ thống.',
            ],
            [
                'name'=>'Quà tặng người mới',
                'voucher_code'=>'QuaTangNguoiMoi',
                'value'=>'Phần trăm',
                'decreased_value'=>'10',
                'max_value'=>'1000000',
                'quanlity'=>'100',
                'remaini'=>'100',
                'condition'=>'0',
                'date_start'=>Date("Y-m-d"),
                'date_end'=>'2025-10-03',
                'type_code'=>'Công khai', 
                'status'=>'Đang diên ra',
                'description'=>'Quà tặng cho người dùng mới.',
            ],
        ];
        foreach ($datas as $data) {
            Voucher::query()->create($data);
        }
    }
}