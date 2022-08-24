<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdocumentsUserObjInsuranceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edocuments_user_obj_insurance', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('obj_id');
            $table->unsignedInteger('document_id');

            $table->foreign('document_id')->references('id')->on('edocument_users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edocuments_products');
    }
}
