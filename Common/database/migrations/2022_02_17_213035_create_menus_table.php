<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {

            $table->increments('id');
            $table->longText('name')->nullable();
            $table->longText('title')->nullable();
            $table->string('attrclass')->nullable();
            $table->string('attrid')->nullable();
            $table->boolean('wrapper')->default(1);
            $table->boolean('order')->default(0);
            $table->boolean('is_active')->default(1);

            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
