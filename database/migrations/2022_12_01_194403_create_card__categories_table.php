<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card__categories', function (Blueprint $table) {
            $table->id();
            $table->integer('card')->unsigned();
            $table->integer('category')->unsigned();            
            $table->timestamps();

            $table->foreignId('card_id')
                  ->constrained();

            $table->foreignId('category_id')
                  ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card__categories');
    }
}
