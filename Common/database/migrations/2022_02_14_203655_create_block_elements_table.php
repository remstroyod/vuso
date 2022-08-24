<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block_elements', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('block_id')->nullable();
            $table->longText('title')->nullable();
            $table->longText('subtitle')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->string('link', 255)->nullable();
            $table->longText('linktext')->nullable();
            $table->string('image')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('order')->default(1);

            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->boolean('is_active')->default(1);

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('block_id')->references('id')->on('blocks')
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
        Schema::dropIfExists('block_elements');
    }
}
