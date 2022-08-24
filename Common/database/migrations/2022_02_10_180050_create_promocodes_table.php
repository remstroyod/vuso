<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePromocodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocodes', function (Blueprint $table) {

            $table->increments('id');
            $table->longText('name')->nullable();
            $table->string('code', 32)->unique();
            $table->double('reward', 10, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->text('data')->nullable();
            $table->longText('description')->nullable();
            $table->integer('uses')->unsigned()->default(0);
            $table->tinyInteger('type')->unsigned()->default(1);
            $table->boolean('is_disposable')->default(false);
            $table->timestamp('expires_at')->nullable();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promocodes');
    }
}
