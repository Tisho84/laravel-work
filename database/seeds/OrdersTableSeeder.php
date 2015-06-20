<?php

use App\Address;
use App\Order;
use App\OrderStatus;
use App\Payment;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;

class OrdersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $users = User::lists('id');
        $orderStatuses = OrderStatus::lists('id');
        $addresses = Address::lists('id');
        $payments = Payment::lists('id');
        foreach (range(1, 30) as $index) {
            Order::create([
                'user_id'    => $faker->randomElement($users),
                'address_id' => $addresses[$index],
                'payment_id' => $payments[$index],
                'status_id'  => $faker->randomElement($orderStatuses),
                'processed_on' => $faker->unixTime,
                'shipped_on' => $faker->unixTime,
                'expected_delivery_on' => $faker->unixTime,
                'delivered_on' => $faker->unixTime,
            ]);


        }
    }

}
