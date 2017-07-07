<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('screen_name');
            $table->string('location');
            $table->string('description');
            $table->string('url');
            $table->integer('followers');
            $table->integer('following');
            $table->bigInteger('utc_offset');
            $table->string('time_zone');
            $table->string('image_url');
            $table->string('banner_url');
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
        Schema::table('profiles', function (Blueprint $table) {
            //
        });
    }
}
