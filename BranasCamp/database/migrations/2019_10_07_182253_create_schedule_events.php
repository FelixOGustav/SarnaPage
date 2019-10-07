<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_events', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('time');
            $table->dateTime('time_end')->nullable();
            $table->string('title', 150);
            $table->string('description', 600)->nullable();
            $table->tinyInteger('leader')->nullable();
            $table->tinyInteger('gym_plus')->nullable();
            $table->string('changed_by', 100);
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
        Schema::dropIfExists('schedule_events');
    }
}
