<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameofthrones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gameofthrones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250);
            $table->text('description');
            $table->integer('wins')->nullable();
            $table->string('place', 100);
            $table->string('responsible', 250);
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
        Schema::dropIfExists('gameofthrones');
    }
}
