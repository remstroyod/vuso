<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductRelevantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_product', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('product_relevant_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('product_relevant_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_product');
    }
}
