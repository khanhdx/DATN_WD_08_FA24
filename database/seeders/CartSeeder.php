<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        
        // Giả sử bạn đã có các giỏ hàng (carts) được tạo trước
        $carts = Cart::all();
        
        foreach ($carts as $cart) {
            foreach (range(1, 5) as $index) {
                // Lấy ngẫu nhiên một biến thể sản phẩm (product_variant)
                $productVariant = ProductVariant::inRandomOrder()->first();
                
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_variant_id' => $productVariant->id,  // Sử dụng product_variant_id
                    'quantity' => $quantity = $faker->numberBetween(1, 5),
                    'price' => $productVariant->price,
                ]);
            }
        }
    }
}
