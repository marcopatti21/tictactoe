<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cell_0')->nullable();
            $table->integer('cell_1')->nullable();
            $table->integer('cell_2')->nullable();
            $table->integer('cell_3')->nullable();
            $table->integer('cell_4')->nullable();
            $table->integer('cell_5')->nullable();
            $table->integer('cell_6')->nullable();
            $table->integer('cell_7')->nullable();
            $table->integer('cell_8')->nullable();
            $table->integer('next_player_id')->nullable();
            $table->integer('winner_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('games');
    }
};
