<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cars', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('model')->nullable();
            $table->string('number')->nullable();
            $table->integer('engine')->nullable();
            $table->integer('price')->default(0);
            $table->year('year')->nullable();

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
        Schema::dropIfExists('user_cars');
    }
}
