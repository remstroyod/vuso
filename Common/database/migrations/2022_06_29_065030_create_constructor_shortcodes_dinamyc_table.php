<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConstructorShortcodesDinamycTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructor_shortcodes_dinamyc', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('shortcode_id')->nullable();
            $table->unsignedInteger('page_id')->nullable();
            $table->unsignedInteger('product_id')->after('page_id')->nullable();
            $table->string('name')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->longText('template')->nullable();
            $table->string('image')->nullable();
            $table->longText('icon')->nullable();
            $table->string('url_one')->nullable();
            $table->string('url_two')->nullable();
            $table->string('url_one_title')->nullable();
            $table->string('url_two_title')->nullable();
            $table->string('source')->nullable();
            $table->boolean('type')->default(1);
            $table->boolean('is_active')->default(\Backend\Enums\ConstructorDinamycEnum::faq);
            $table->string('shortcode')->nullable();
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('shortcode_id')->references('id')->on('constructor_shortcodes')
                ->onDelete('cascade');

            $table->foreign('page_id')->references('id')->on('pages')
                ->onDelete('cascade');

            $table->foreign('product_id')->references('id')->on('products')
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
        Schema::dropIfExists('constructor_shortcodes_dinamyc');
    }

}
