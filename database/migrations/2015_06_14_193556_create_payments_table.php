<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('type_id')->unsigned();
            $table->string('brand');
            $table->string('last4', 4);
            $table->string('exp_month', 2);
            $table->string('exp_year', 4);
            $table->decimal('amount', 10, 2);
            $table->timestamps();
            $table->foreign('type_id')
                ->references('id')->on('payment_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payments');
    }

}
