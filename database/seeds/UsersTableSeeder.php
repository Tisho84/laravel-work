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

        foreach (range(1, 20) as $index) {
            User::create([
                'name'     => $faker->name,
                'email'    => $faker->email,
                'password' => Hash::make('123456')
            ]);
        }
    }

}