<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdocumentsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edocuments_products', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('document_id')->nullable();
            $table->unsignedInteger('type_id');

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('document_id')->references('id')->on('edocuments_documents');
            $table->foreign('type_id')->references('id')->on('edocuments');

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
