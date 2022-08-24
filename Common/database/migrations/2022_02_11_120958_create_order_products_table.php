<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('document_id')->nullable();
            $table->unsignedInteger('promocode_id')->nullable();
            $table->string('product_id_hash', 255)->unique();
            $table->longText('name')->nullable();
            $table->decimal('price', 15, 3)->default(0);
            $table->integer('quantity')->default(0);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('order_id')->references('id')->on('orders')
                ->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');
            $table->foreign('document_id')->references('id')->on('edocument_users')
                ->onDelete('set null');
            $table->foreign('promocode_id')->references('id')->on('promocodes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
