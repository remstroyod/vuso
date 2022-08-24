<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsuranceDocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurance_docs', function (Blueprint $table) {
            $table->id();
            $table->string('auto_reg_num')->nullable();
            $table->integer('doc_insurance_tariff_id')->nullable();
            $table->string('doc_blank')->unique();
            $table->integer('auto_engine_volume')->nullable();
            $table->string('doc_insurance_tariff_name')->nullable();
            $table->string('auto_type')->nullable();
            $table->string('doc_end_date')->nullable();
            $table->string('doc_product')->nullable();
            $table->string('doc_action_name')->nullable();
            $table->integer('auto_tumber_passengers')->nullable();
            $table->integer('doc_action_id')->nullable();
            $table->integer('doc_amount')->nullable();
            $table->double('doc_payment')->nullable();
            $table->string('doc_on_date')->nullable();
            $table->string('doc_inure_date')->nullable();
            $table->string('adress')->nullable();
            $table->string('auto_mark')->nullable();
            $table->string('insured')->nullable();
            $table->string('auto_model')->nullable();
            $table->integer('auto_cargo')->nullable();
            $table->string('auto_vin')->nullable();
            $table->integer('auto_year')->nullable();
            $table->string('auto_run')->nullable();
            $table->string('autocost')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('status_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('insurance_status_lists');

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
        Schema::dropIfExists('insurance_docs');
    }
}
