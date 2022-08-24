<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjInsurancePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obj_insurance_person', function (Blueprint $table) {
            $table->id();
            $table->string('middle_name')->nullable();
            $table->integer('lk_Id')->nullable();
            $table->string('address_string')->nullable();
            $table->string('INN')->nullable();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('birthday')->nullable();
            $table->string('mail')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('code')->nullable();
            $table->string('ukr_passport')->nullable();
            $table->string('international_passport')->nullable();
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
        Schema::dropIfExists('obj_insurance_person');
    }
}
