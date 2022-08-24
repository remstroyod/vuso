<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('seo_id')->nullable();
            $table->longText('name')->nullable(false);
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->longText('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('order')->default(0);
            $table->boolean('is_banner')->default(0);
            $table->boolean('is_sale')->default(0);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_popular')->default(0);
            $table->boolean('is_header')->default(1);
            $table->boolean('is_footer')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('articles_categories')
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
        Schema::dropIfExists('articles');
    }
}
