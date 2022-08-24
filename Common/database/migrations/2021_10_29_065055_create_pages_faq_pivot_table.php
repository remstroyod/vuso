<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesFaqPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq_pages', function (Blueprint $table) {

            $table->unsignedInteger('pages_page')->nullable(false);
            $table->unsignedInteger('faq_id')->nullable(false);

            $table->foreign('faq_id')->references('id')->on('faqs')
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
        Schema::dropIfExists('faq_pages');
    }
}
