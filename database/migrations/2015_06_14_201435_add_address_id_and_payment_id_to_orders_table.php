<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressIdAndPaymentIdToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
            $table->integer('address_id')->unsigned();
            $table->foreign('address_id')
                ->references('id')->on('addresses');

            $table->integer('payment_id')->unsigned();
            $table->foreign('payment_id')
                ->references('id')->on('payments');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
            $table->dropForeign('orders_address_id_foreign');
            $table->dropColumn('address_id');

            $table->dropForeign('orders_payment_id_foreign');
            $table->dropColumn('payment_id');
		});
	}

}
