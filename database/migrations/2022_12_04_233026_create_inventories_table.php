<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quantity');
            $table->timestamps();

            $table->unsignedBigInteger('card_id')
                  ->onDelete('cascade')
                  ->onDelete('cascade')
                  ->unique()
                  ->nullable();

            $table->foreign('card_id')
                  ->references('id')
                  ->on('cards')
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
        Schema::dropIfExists('inventories');
    }
}
