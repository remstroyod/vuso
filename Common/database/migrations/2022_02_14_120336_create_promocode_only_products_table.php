<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromocodeOnlyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocode_only_products', function (Blueprint $table) {
            $table->unsignedInteger('promocode_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();

            $table->foreign('promocode_id')->references('id')->on('promocodes')
                ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promocode_only_products');
    }
}
