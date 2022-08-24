<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjInsuranceBuildingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obj_insurance_buildings', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('country_id')->nullable();
            $table->string('city_id')->nullable();
            $table->string('real_estate_form')->nullable();
            $table->string('property_type')->nullable();
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
        Schema::dropIfExists('obj_insurance_buildings');
    }
}
