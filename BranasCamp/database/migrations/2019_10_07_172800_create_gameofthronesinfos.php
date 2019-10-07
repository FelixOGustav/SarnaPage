<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameofthronesinfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameofthronesinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->string('link', 250)->nullable();
            $table->tinyInteger('vote_open')->nullable();
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
        Schema::dropIfExists('gameofthronesinfos');
    }
}
