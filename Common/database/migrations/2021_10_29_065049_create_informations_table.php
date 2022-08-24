<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informations', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('seo_id')->nullable();

            $table->longText('name')->nullable(false);
            $table->string('file')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->unsignedSmallInteger('order')->nullable();
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('informations_categories')
                ->onDelete('cascade');
            $table->foreign('seo_id')->references('id')->on('seo')
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
        Schema::dropIfExists('informations');
    }
}
