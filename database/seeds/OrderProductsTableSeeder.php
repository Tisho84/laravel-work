<?php

use App\Order;
use App\OrderProduct;
use App\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;


class OrderProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $orders = Order::lists('id');
        $products = Product::lists('id');
        foreach(range(1, 45) as $index) {
            if($index > 25){
                $index -= 25;
            }
            OrderProduct::create([
                'order_id' => $orders[$index],
                'product_id' => $faker->randomElement($products),
                'quantity' => $faker->numberBetween(1, 3)
            ]);
        }
    }
}
