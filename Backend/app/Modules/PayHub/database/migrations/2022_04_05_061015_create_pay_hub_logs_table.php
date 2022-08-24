<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayHubLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payhub_logs', function (Blueprint $table)
        {

            $table->increments('id');
            $table->unsignedInteger('system_id')->nullable();
            $table->unsignedInteger('document_id')->nullable();
            $table->boolean('status')->default(0);
            $table->json('request')->nullable();

            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));

            $table->foreign('system_id')->references('id')->on('payhub_systems')
                ->onDelete('set null');
            $table->foreign('document_id')->references('id')->on('edocument_users')
                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payhub_logs');
    }
}
