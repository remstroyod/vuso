<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('h1')->nullable();
            $table->longText('title')->nullable();
            $table->text('description')->nullable();
            $table->longText('keyword')->nullable();
            $table->boolean('robots')->default(true);
            $table->string('canonical')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->longText('text')->nullable();
            $table->boolean('text_active')->default(true);
            $table->string('image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seo');
    }
}
