<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RegistrationsLeader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations_leaders', function (Blueprint $table) {
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
            $table->string('allergy', 300)->nullable();
            $table->string('first_name_advocate');
            $table->string('last_name_advocate');
            $table->string('email_advocate');
            $table->timestamp('verified_at')->nullable();
            $table->string('phone_number_advocate');
            $table->string('home_number')->nullable();
            $table->integer('place');
            $table->boolean('member');
            $table->integer('member_place')->nullable();
            $table->boolean('kitchen');
            $table->integer('cost')->default(1500)->nullable();
            $table->string('other', 1000)->nullable();
            $table->boolean('terms');
            $table->integer('camp_id');
            $table->string('verification_key')->nullable();
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
        Schema::dropIfExists('tblregistrations_leader');
    }
}
