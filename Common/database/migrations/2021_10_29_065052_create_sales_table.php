<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('category_id')->nullable();
            $table->unsignedInteger('seo_id')->nullable();

            $table->longText('name')->nullable(false);
            $table->string('image')->nullable();
            $table->mediumText('excerpt')->nullable();
            $table->dateTime('date_end')->nullable();
            $table->longText('description')->nullable();
            $table->string('file')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('category_id')->references('id')->on('sales_categories')
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
        Schema::dropIfExists('sales');
    }
}
