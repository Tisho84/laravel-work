<?php

use App\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory;

class ServicesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 30) as $index) {
            Service::create([
                'name'          => $faker->word,
                'available_m25' => $faker->boolean(),
                'other_info'    => $faker->sentence()
            ]);
        }
    }

}
