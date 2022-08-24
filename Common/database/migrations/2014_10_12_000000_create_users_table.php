<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->increments('id');
            $table->uuid('guid')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_active')->default(1);
            $table->rememberToken();
            $table->string('sms_code', 4)->nullable()->unique();
            $table->string('otp', 6)->nullable();
            $table->dateTime('created_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('users');
    }
}
