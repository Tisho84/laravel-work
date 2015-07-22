<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::create([
            'first_name' => 'Tihomir',
            'last_name' => 'Kamenov',
            'email' => 'tihomir.kamenov@1stonlinesolutions.com',
            'phone' => '0883358011',
            'username' => 'admin',
            'active' => 1,
            'password' => '123456',
            'is_admin' => 1
        ]);
        foreach (range(1, 20) as $index) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'username' => $faker->userName,
                'active' => $faker->boolean(80),
                'password' => '123456',
            ]);
        }
    }

}