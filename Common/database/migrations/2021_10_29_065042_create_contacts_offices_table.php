<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts_offices', function (Blueprint $table) {

            $table->increments('id');

            $table->unsignedInteger('country_id')->nullable();

            $table->longText('name')->nullable(false);
            $table->longText('address')->nullable();
            $table->longText('time')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->boolean('is_active')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('country_id')->references('id')->on('contacts_countries')
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
        Schema::dropIfExists('contacts_offices');
    }
}
