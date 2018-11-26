<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appid')->index();
            $table->string('country')->nullable()->index();
            $table->integer('final')->nullable()->index();
            $table->integer('initial')->nullable()->index();
            $table->integer('discount')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_prices');
    }
}
