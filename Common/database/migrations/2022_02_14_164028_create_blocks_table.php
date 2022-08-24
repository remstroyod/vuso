<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('page_id')->nullable();
            $table->string('model')->nullable();
            $table->longText('content')->nullable();
            $table->longText('subtitle')->nullable();
            $table->longText('title')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->string('link', 255)->nullable();
            $table->longText('linktext')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->longText('videotitle')->nullable();
            $table->string('videoposter')->nullable();
            $table->boolean('order')->default(1);
            $table->string('component', 255)->nullable();
            $table->string('position')->nullable();

            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->boolean('is_active')->default(1);

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

//            $table->foreign('page_id')->references('id')->on('pages')
//                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blocks');
    }
}
