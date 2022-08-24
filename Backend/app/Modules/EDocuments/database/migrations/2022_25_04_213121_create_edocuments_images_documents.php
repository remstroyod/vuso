<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdocumentsImagesDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('edocuments_images_documents', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('document_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('image', 255)->nullable();
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('document_id')->references('id')->on('edocuments_documents')
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
        Schema::dropIfExists('edocuments_images_documents');
    }
}
