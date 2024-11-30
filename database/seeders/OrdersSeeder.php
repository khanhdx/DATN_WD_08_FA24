<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\User;
use App\Models\StatusOrder;
use App\Models\Shipper;
use Faker\Factory as Faker;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            Order::create([
                'user_id' => User::inRandomOrder()->first()->id, // Lấy user ngẫu nhiên
                'status_order_id' => StatusOrder::inRandomOrder()->first()->id, // Lấy trạng thái ngẫu nhiên
                'shipper_id' => Shipper::inRandomOrder()->first()->id, // Lấy shipper ngẫu nhiên
                'date' => $faker->dateTimeThisYear, // Ngày ngẫu nhiên trong năm hiện tại
                'total_price' => $faker->randomFloat(2, 100000, 10000000), // Giá trị từ 100.000 đến 10.000.000
                'shipping_fee' => $faker->randomFloat(2, 20000, 100000), // Phí giao hàng từ 20.000 đến 100.000
                'payment_method' => $faker->randomElement(['Tiền mặt', 'Chuyển khoản', 'Thẻ tín dụng']), // Phương thức thanh toán ngẫu nhiên
                'payment_status' => $faker->randomElement(['chưa thanh toán', 'đã thanh toán', 'hoàn tiền']), // Trạng thái thanh toán ngẫu nhiên
                'transaction_id' => $faker->optional()->uuid, // ID giao dịch hoặc null
                'address' => $faker->address, // Địa chỉ giả
                'note' => $faker->optional()->sentence, // Ghi chú ngẫu nhiên hoặc null
                'coupon_code' => $faker->optional()->regexify('[A-Z0-9]{5}'), // Mã giảm giá ngẫu nhiên
                'discount_amount' => $faker->randomFloat(2, 0, 500000), // Giảm giá từ 0 đến 500.000
            ]);
        }
    }
}
