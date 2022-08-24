<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_detail', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('user_id')->unique();

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('view_name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->date('birthday')->nullable();
            $table->string('image')->nullable();
            $table->string('avatar')->nullable();
            $table->string('website')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->mediumText('address')->nullable();
            $table->mediumText('street')->nullable();
            $table->boolean('type_street')->default(1);
            $table->string('house_number')->nullable();
            $table->string('apartment_number')->nullable();
            $table->string('passport_id')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('international_first_name')->nullable();
            $table->string('international_last_name')->nullable();
            $table->string('international_passport')->nullable();
            $table->mediumText('about')->nullable();

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')
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
        Schema::dropIfExists('users_detail');
    }
}
