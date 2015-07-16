<?php

use App\Address;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;
use App\Classes\OrderStatus;

class OrdersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = OrderStatus::$statuses;
        $keys = array_keys($statuses);
        $faker = Factory::create();
        $users = User::lists('id');
        $addresses = Address::lists('id');
        foreach (range(1, 30) as $index) {
            Order::create([
                'user_id'    => $faker->randomElement($users),
                'address_id' => $addresses[$index],
                'status'  => $faker->randomElement($keys),
                'processed_on' => $faker->unixTime,
                'shipped_on' => $faker->unixTime,
                'expected_delivery_on' => $faker->unixTime,
                'delivered_on' => $faker->unixTime,
            ]);


        }
    }

}
