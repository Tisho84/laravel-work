<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeStatusToStatusIdInOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn('status');
            $table->integer('status_id')->unsigned();
            $table->foreign('status_id')
                ->references('id')->on('order_statuses');
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
			$table->string('status');
            $table->dropForeign('orders_status_id_foreign');
            $table->dropColumn('status_id');
		});
	}

}
