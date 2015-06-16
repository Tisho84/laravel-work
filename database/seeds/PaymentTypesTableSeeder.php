<?php

use App\PaymentType;
use Illuminate\Database\Seeder;

class PaymentTypesTableSeeder extends Seeder
{
    public function run()
    {
        $types = ['cash', 'credit card', 'other'];
        foreach($types as $type) {
            PaymentType::create(['name' => $type]);
        }
    }
}
