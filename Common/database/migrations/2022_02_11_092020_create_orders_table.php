<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_id', 255)->unique();
            $table->string('doc_blank_1c')->nullable();
            $table->uuid('guid')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->boolean('status')->default(1);
            $table->decimal('total', 15, 3)->default(0);
            $table->decimal('subtotal', 15, 3)->default(0);
            $table->boolean('is_payment')->default(0);

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('orders');
    }
}
