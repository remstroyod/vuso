<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->unsignedInteger('menu_id')->nullable();
            $table->longText('title')->nullable();
            $table->string('url', 255)->nullable();
            $table->string('attrclass')->nullable();
            $table->string('attrid')->nullable();
            $table->longText('attrtitle')->nullable();
            $table->string('attrtarget')->nullable();
            $table->string('attrrel')->nullable();
            $table->string('icon')->nullable();
            $table->longText('iconsvg')->nullable();
            $table->string('iconposition', 50)->nullable();
            $table->boolean('order')->default(0);
            $table->boolean('is_active')->default(1);

            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('parent_id')->references('id')->on('menu_items')
                ->onDelete('set null');

            $table->foreign('menu_id')->references('id')->on('menus')
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
        Schema::dropIfExists('menu_items');
    }
}
