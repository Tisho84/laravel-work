<?php

use App\Category;
use App\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $categories = Category::lists('id');

        foreach (range(1, 50) as $index) {
            Product::create([
                'name' => $faker->name,
                'available' => $faker->boolean(85),
                'quantity' => $faker->numberBetween(0, 100),
                'active' => $faker->boolean(85),
                'category_id' => $faker->randomElement($categories),
                'description' => $faker->sentence,
                'price' => $faker->randomNumber(4)
            ]);
        }
    }
}
