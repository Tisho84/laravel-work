<?php

use App\Address;
use Faker\Factory;
use Illuminate\Database\Seeder;
use App\Classes\AddressType;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        $types = AddressType::$types;
        $keys = array_keys($types);
        $faker = Factory::create();
        foreach(range(0, 30) as $index) {
            Address::create([
                'type' => $faker->randomElement($keys),
                'street' => $faker->streetName,
                'city' => $faker->city,
                'country' => $faker->country,
                'zip' => $faker->countryCode
            ]);
        }
    }
}
