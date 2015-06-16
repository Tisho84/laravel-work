<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		$this->call('UsersTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('ProductsTableSeeder');
		$this->call('OrderStatusesTableSeeder');
        $this->call('PaymentTypesTableSeeder');
        $this->call('PaymentsTableSeeder');
        $this->call('AddressTypesTableSeeder');
        $this->call('AddressesTableSeeder');
        $this->call('OrdersTableSeeder');
        $this->call('OrderProductsTableSeeder');
		//$this->call('ServicesTableSeeder');

	}

}
