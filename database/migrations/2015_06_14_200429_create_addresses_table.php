<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->string('street');
            $table->string('city');
            $table->string('zip');
            $table->string('country');
            $table->timestamps();
            $table->foreign('type_id')
                ->references('id')->on('address_types');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('addresses');
	}

}
