<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('appid')->unique();
            $table->boolean('free')->nullable()->index();
            $table->string('name')->index();
            $table->string('chinese_name')->nullable()->index();
            $table->integer('metacritic_score')->nullable()->index();
            $table->integer('steam_user_score')->nullable()->index();
            $table->text('detailed_description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('platforms')->nullable()->index();
            $table->timestamp('released_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('game_lists');
    }
}
