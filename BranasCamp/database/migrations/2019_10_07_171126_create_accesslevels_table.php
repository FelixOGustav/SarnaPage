<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesslevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesslevels', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('admin')->nullable();
            $table->tinyInteger('allergy')->nullable();
            $table->tinyInteger('other')->nullable();
            $table->tinyInteger('ljung')->nullable();
            $table->tinyInteger('vargarda')->nullable();
            $table->tinyInteger('asklanda_ornunga')->nullable();
            $table->tinyInteger('bergstena_ostadkulle')->nullable();
            $table->tinyInteger('ljurhalla')->nullable();
            $table->tinyInteger('t_r_e')->nullable();
            $table->tinyInteger('borgstena_tamta')->nullable();
            $table->tinyInteger('storsjostrand')->nullable();
            $table->tinyInteger('persnr')->nullable();
            $table->tinyInteger('contact_info')->nullable();
            $table->tinyInteger('contact_info_advocate')->nullable();
            $table->tinyInteger('verify_registration')->nullable();
            $table->tinyInteger('edit_registration')->nullable();
            $table->tinyInteger('manage_camp')->nullable();
            $table->tinyInteger('herrljunga')->nullable();
            $table->tinyInteger('add_user')->nullable();
            $table->tinyInteger('manage_user')->nullable();
            $table->tinyInteger('statistics')->nullable();
            $table->tinyInteger('schedule')->nullable();
            $table->tinyInteger('kitchen')->nullable();
            $table->tinyInteger('age')->nullable();
            $table->tinyInteger('game_of_thrones')->nullable();
            $table->tinyInteger('insamling')->nullable();
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
        Schema::dropIfExists('accesslevels');
    }
}
