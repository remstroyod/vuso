<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProvidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_providers', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable()->unique();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_providers');
    }
}
