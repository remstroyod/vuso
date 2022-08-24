<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromocodeUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('promocode_user', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('promocode_id');
            $table->timestamp('used_at');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('promocode_id')->references('id')->on('promocodes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promocode_user');
    }
}
