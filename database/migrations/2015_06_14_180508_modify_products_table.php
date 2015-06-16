<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function(Blueprint $table)
        {
            $table->renameColumn('available_m25', 'available');
            $table->dropColumn('other_info');
            $table->integer('quantity');
            $table->boolean('active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function(Blueprint $table)
        {
            $table->renameColumn('available', 'available_m25');
            $table->string('other_info');
            $table->dropColumn('quantity');
            $table->dropColumn('active');
        });
    }

}
