<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Egorovwebservices\Payhub\Interfaces\System;
use Backend\Modules\PayHub\Models\PayHubSystem;

class ChangePayhubSystemTable extends Migration
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
        Schema::table($this->Model->getTable(), function(Blueprint $table) {
            $table->dropColumn('urlSuccess');
            $table->dropColumn('urlFailed');

            $table->boolean($this->Model->getIsDefaultColumn())->default(0)->after($this->Model->getKeyColumn());
            $table->boolean($this->Model->getIsRecurrentColumn())->default(0)->after($this->Model->getIsDefaultColumn());
            $table->boolean($this->Model->getHas3dsColumn())->default(1)->after($this->Model->getIsRecurrentColumn());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}