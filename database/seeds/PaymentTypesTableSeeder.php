<?php

use App\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
{
    public function run()
    {
        $types = [
            [
                'name' => 'cash',
                'card_info' => 0,
            ],
            [
                'name' => 'credit card',
                'card_info' => 1,
            ],
            [
                'name' => 'other',
                'card_info' => 0,
            ]
        ];
        foreach($types as $type) {
            PaymentType::create([
                'name' => $type['name'],
                'card_info' => $type['card_info']
            ]);
        }
    }
}
