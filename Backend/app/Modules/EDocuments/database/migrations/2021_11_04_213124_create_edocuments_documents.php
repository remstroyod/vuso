<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEdocumentsDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edocuments_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('documents_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            //$table->longText('template')->nullable();
            $table->string('file', 255)->nullable();
            $table->string('filename', 255)->nullable();
            $table->boolean('extension')->default(1);
            $table->boolean('is_active')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('documents_id')->references('id')->on('edocuments')
                ->onDelete('cascade');
        });

        DB::statement("ALTER TABLE edocuments_documents ADD template MEDIUMBLOB");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edocuments_documents');
    }
}
