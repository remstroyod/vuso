<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages_tags', function (Blueprint $table) {

            $table->unsignedInteger('pages_id')->unsigned()->index();
            $table->unsignedInteger('tag_id')->unsigned()->index();

            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages_tags');
    }
}
