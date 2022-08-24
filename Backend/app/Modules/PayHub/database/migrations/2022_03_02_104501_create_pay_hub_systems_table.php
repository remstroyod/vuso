<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Egorovwebservices\Payhub\Interfaces\System;
use Backend\Modules\PayHub\Models\PayHubSystem;

class CreatePayHubSystemsTable extends Migration
{
    private System $Model;

    public function __construct()
    {
        $this->Model = new PayHubSystem();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->Model->getTable(), function (Blueprint $table)
        {
            $table->increments('id');

            $table->string('name', 255)->nullable();
            $table->string($this->Model->getKeyColumn())->index();

            $table->string('urlApi', 255)->nullable();
            $table->string('partnerKey', 255)->nullable();
            $table->string('seviceKey', 255)->nullable();
            $table->string('secretKey', 255)->nullable();
            $table->string('urlSuccess', 255)->nullable();
            $table->string('urlFailed', 255)->nullable();

            $table->dateTime('published_at', 0)->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->Model->getTable());
    }
}
