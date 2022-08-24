<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportFaqTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_faq', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('support_faq');
    }
}
