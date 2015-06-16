<?php

use App\AddressType;
use Illuminate\Database\Seeder;

class AddressTypesTableSeeder extends Seeder
{
    public function run()
    {
        $types = ['Home', 'Mail', 'Business', 'Billing', 'Other'];
        foreach($types as $type) {
            AddressType::create(['name' => $type]);
        }
    }
}
