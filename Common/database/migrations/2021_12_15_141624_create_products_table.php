<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('seo_id')->nullable();
            $table->unsignedInteger('payhub_id')->nullable();
            $table->longText('name')->nullable(false);
            $table->string('doc_name_1c')->nullable();
            $table->integer('doc_id_1c')->nullable();
            $table->longText('short_name')->nullable();
            $table->text('description')->nullable();
            $table->mediumText('excerpt')->nullable();
            $table->string('image')->nullable();
            $table->longText('icon_svg')->nullable();
            $table->string('slug')->unique();
            $table->longText('scenario')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('is_popular')->default(0);
            $table->boolean('is_header')->default(1);
            $table->boolean('is_footer')->default(1);
            $table->boolean('type')->default(1);
            $table->string('token')->nullable();
            $table->unsignedSmallInteger('order')->nullable();
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('seo_id')->references('id')->on('seo')
                ->onDelete('cascade');
            $table->foreign('payhub_id')->references('id')->on('payhub_systems')
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
        Schema::dropIfExists('products');
    }
}
