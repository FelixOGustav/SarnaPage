<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStartpageInfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('startpage_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string("type", 100);
            $table->string("title", 200)->nullable();
            $table->text("body")->nullable();
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
        Schema::table('startpage_infos', function (Blueprint $table) {
            //
        });
    }
}
