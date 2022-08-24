<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjInsuranceCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obj_insurance_cars', function (Blueprint $table) {
            $table->id();
            $table->string('reg_num')->nullable();
            $table->integer('engine_volume')->nullable();
            $table->string('type')->nullable();
            $table->integer('number_passengers')->nullable();
            $table->string('mark')->nullable();
            $table->string('model')->nullable();
            $table->integer('cargo')->nullable();
            $table->string('vin')->unique();
            $table->integer('year')->nullable();
            $table->string('run')->nullable();
            $table->string('cost')->nullable();
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('obj_insurance_cars');
    }
}
