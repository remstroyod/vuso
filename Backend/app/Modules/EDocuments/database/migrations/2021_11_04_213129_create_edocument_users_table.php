<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEdocumentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('edocument_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('documents_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
//            $table->unsignedInteger('product_id')->nullable();
            $table->string('status_id')->nullable();
            $table->string('doc_end_date')->nullable();
            $table->string('doc_blank_1c')->nullable()->unique();
            $table->string('obj_type')->nullable();
            $table->string('obj_model')->nullable();
            $table->string('dogovor_id', 255)->nullable();
            $table->decimal('subtotal', 15, 3)->default(0);
            $table->decimal('total', 15, 3)->default(0);
            $table->string('storage', 255)->nullable();
            $table->string('folder', 255)->nullable();
            $table->string('path', 255)->nullable();
            $table->string('filename', 255)->nullable();
            $table->string('mimetype', 255)->nullable();
            $table->string('url', 255)->nullable();
            $table->boolean('extension')->default(1);
            $table->boolean('source')->default(1);
            $table->json('data')->nullable();
            $table->boolean('payment_status')->default(0);
            $table->string('transaction_id', 255)->nullable();
            $table->string('transaction_hash', 75)->unique();
            $table->boolean('is_pp')->default(0);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();
            $table->foreign('documents_id')->references('id')->on('edocuments')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('edocument_users');
    }
}
