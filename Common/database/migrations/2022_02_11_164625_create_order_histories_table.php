<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_histories', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('order_id')->nullable();
            $table->boolean('status')->default(1);

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('order_id')->references('id')->on('orders')
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
        Schema::dropIfExists('order_histories');
    }
}
