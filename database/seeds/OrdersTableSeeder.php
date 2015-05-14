<?php

use App\Order;
use App\Service;
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
        $faker    = Factory::create();
        $users    = User::lists('id');
        $services = Service::lists('id');

        foreach (range(1, 60) as $index) {
            Order::create([
                'user_id'    => $faker->randomElement($users),
                'service_id' => $faker->randomElement($services),
                'amount'     => $faker->randomFloat(2, 36, 500)
            ]);
        }
    }

}
