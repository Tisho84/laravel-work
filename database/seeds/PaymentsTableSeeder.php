<?php

use App\Payment;
use App\PaymentType;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Factory::create();
        $types = PaymentType::lists('id');
        $year = date('Y');
        foreach(range(0, 30) as $index) {
            $array = [
                'type_id' => $faker->randomElement($types),
                'brand' => $faker->domainName,
                'last4' => $faker->numberBetween(0, 9999),
                'exp_month' => $faker->month,
                'exp_year' => $year + $faker->numberBetween(1, 3),
                'amount' => $faker->randomFloat(2, 36, 500)
            ];
            
            if($array['type_id'] == 2)
            {
                $array['paid_on'] = Carbon\Carbon::now();
            }
            Payment::create($array);
        }
    }
}
