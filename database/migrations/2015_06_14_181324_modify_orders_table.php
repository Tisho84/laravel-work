<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('orders', function(Blueprint $table)
        {
            $table->dropColumn('user_id');
        });

		Schema::table('orders', function(Blueprint $table)
        {
			$table->dropColumn(['service_id', 'amount']);
            $table->dropTimestamps();
            $table->timestamp('processed_on');
            $table->timestamp('shipped_on');
            $table->timestamp('expected_delivery_on');
            $table->timestamp('delivered_on');
            $table->tinyInteger('status');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
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
            $table->decimal('amount', 10, 2);
            $table->timestamps();
            $table->dropColumn(['processed_on', 'shipped_on', 'expected_delivery_on', 'delivered_on', 'status']);

            $table->dropForeign('orders_user_id_foreign');
            $table->dropColumn('user_id');

            $table->integer('service_id');
        });

        Schema::table('orders', function(Blueprint $table)
        {
            $table->integer('user_id');
        });

	}

}
