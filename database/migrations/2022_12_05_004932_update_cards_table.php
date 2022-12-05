<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cards', function (Blueprint $table) {
            $table->unsignedBigInteger('inventory_id')
                  ->onDelete('cascade')
                  ->onDelete('cascade')
                  ->nullable();

            $table->unsignedBigInteger('discount_id')
                  ->onDelete('cascade')
                  ->onDelete('cascade')
                  ->nullable();

            $table->foreign('inventory_id')
                  ->references('id')
                  ->on('inventories');

            $table->foreign('discount_id')
                  ->references('id')
                  ->on('discounts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
