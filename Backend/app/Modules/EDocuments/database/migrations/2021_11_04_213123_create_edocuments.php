<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edocuments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(1);
            $table->boolean('type')->default(2);
            $table->boolean('use')->default(1);
            $table->string('endpoint', 50)->nullable()->unique();
            $table->longText('folder')->nullable();
            $table->string('filename', 255)->nullable();
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
        Schema::dropIfExists('edocuments');
    }
}
