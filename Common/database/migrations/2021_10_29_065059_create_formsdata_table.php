<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formsdata', function (Blueprint $table) {

            $table->increments('id');
            $table->boolean('type')->default(0);
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->mediumText('message')->nullable();
            $table->string('ip', 40)->nullable();
            $table->string('url')->nullable();
            $table->mediumText('browser')->nullable();
            $table->boolean('is_auth')->default(false);
            $table->mediumText('source')->nullable();

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formsdata');
    }
}
