<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Registrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthdate');
            $table->string('last_four');
            $table->string('address');
            $table->string('zip');
            $table->string('city');
            $table->string('email');
            $table->string('phonenumber');
            $table->string('allergy', 300)->default(null)->nullable();
            $table->string('first_name_advocate');
            $table->string('last_name_advocate');
            $table->date('birthdate_advocate');
            $table->string('last_four_advocate');
            $table->string('email_advocate');
            $table->timestamp('verified_at')->default(null)->nullable();
            $table->string('phone_number_advocate');
            $table->string('home_number')->default(null)->nullable();
            $table->integer('place');
            $table->boolean('member');
            $table->integer('member_place')->default(null)->nullable();
            $table->integer('cost')->default(1450)->nullable();
            $table->string('other', 1000)->default(null)->nullable();
            $table->boolean('terms');
            $table->integer('camp_id');
            $table->string('verification_key')->default(null)->nullable();
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
        //Schema::dropIfExists('tblregistrations');
    }
}
