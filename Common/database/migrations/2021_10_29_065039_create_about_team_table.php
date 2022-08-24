<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutTeamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_team', function (Blueprint $table) {

            $table->increments('id');
            $table->longText('name')->nullable(false);
            $table->longText('position')->nullable(false);
            $table->longText('description')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('image_revert')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->unsignedSmallInteger('order')->nullable();
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('about_team');
    }
}
