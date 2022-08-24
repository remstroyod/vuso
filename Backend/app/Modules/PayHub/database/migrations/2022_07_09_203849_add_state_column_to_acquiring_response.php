<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Egorovwebservices\Payhub\Models\Response;
use Backend\Modules\PayHub\Models\AcquiringResponse;

class AddStateColumnToAcquiringResponse extends Migration
{
    private Response $Model;

    public function __construct()
    {
        $this->Model = new AcquiringResponse();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table($this->Model->getTable(), function (Blueprint $table) {
            $table->string($this->Model->getAcquiringStatusColumn())->nullable()->after($this->Model->getOrderIdColumn());
            $table->string($this->Model->getPayhubStatusColumn())->nullable()->after($this->Model->getPayhubStatusColumn());
            $table->unsignedBigInteger($this->Model->getSystemIdColumn())->nullable()->after($this->Model->getPayhubStatusColumn());

            $table->text($this->Model->getCancelDataColumn())->nullable()->after($this->Model->getResponseDataColumn());
            $table->text($this->Model->getStateDataColumn())->nullable()->after($this->Model->getCancelDataColumn());
            $table->text($this->Model->getCardDataColumn())->nullable()->after($this->Model->getStateDataColumn());
            $table->text($this->Model->getReceiptColumn())->nullable()->after($this->Model->getCardDataColumn());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->Model->getTable(), function (Blueprint $table) {
            //
        });
    }
}
