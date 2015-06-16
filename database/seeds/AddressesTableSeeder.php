<?php

use App\Address;
use App\AddressType;
use Faker\Factory;
use Illuminate\Database\Seeder;


class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $types = AddressType::lists('id');
        foreach(range(0, 30) as $index) {
            Address::create([
                'type_id' => $faker->randomElement($types),
                'street' => $faker->streetName,
                'city' => $faker->city,
                'country' => $faker->country,
                'zip' => $faker->countryCode
            ]);
        }
    }
}
