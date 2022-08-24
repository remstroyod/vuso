<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_awards', function (Blueprint $table) {

            $table->increments('id');
            $table->longText('name')->nullable(false);
            $table->longText('nomination')->nullable();
            $table->longText('from')->nullable();
            $table->date('date')->format('d.m.Y')->nullable();
            $table->string('file')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
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
        Schema::dropIfExists('about_awards');
    }
}
