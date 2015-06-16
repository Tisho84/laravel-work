<?php

use App\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = ['Pending', 'Processing', 'Preparing', 'Partly Paid', 'Paid',
            'Partly Delivered', 'Delivered', 'Cancelled'];
        foreach($statuses as $status) {
            OrderStatus::create([
                'name' => $status
            ]);
        }
    }
}
