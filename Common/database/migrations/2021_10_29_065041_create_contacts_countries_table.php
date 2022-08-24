<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts_countries', function (Blueprint $table) {

            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('contacts_countries');
    }
}
