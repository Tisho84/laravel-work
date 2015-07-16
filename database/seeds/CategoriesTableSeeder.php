<?php

use App\Category;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();

        foreach (range(1, 10) as $index) {
            Category::create([
                'name' => $faker->firstName,
                'description' => $faker->text(130),
                'active' => $faker->boolean(85),
            ]);
        }
    }
}
