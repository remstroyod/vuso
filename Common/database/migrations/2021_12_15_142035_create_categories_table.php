<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('seo_id')->nullable();
            $table->unsignedInteger('category_type_id')->nullable();
            $table->longText('name')->nullable(false);
            $table->longText('short_name')->nullable(false);
            $table->text('description')->nullable();
            $table->mediumText('excerpt')->nullable();
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_header')->default(1);
            $table->boolean('is_footer')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->boolean('type')->default(1);
            $table->unsignedSmallInteger('order')->nullable();
            $table->string('icon_image')->nullable();
            $table->longText('icon_svg')->nullable();
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('categories')
                ->onDelete('cascade');
            $table->foreign('seo_id')->references('id')->on('seo')
                ->onDelete('cascade');
            $table->foreign('category_type_id')->references('id')->on('category_types')
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
        Schema::dropIfExists('categories');
    }
}
