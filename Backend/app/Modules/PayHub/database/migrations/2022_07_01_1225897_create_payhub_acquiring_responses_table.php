<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePayhubAcquiringResponsesTable extends Migration
{
    private \Illuminate\Database\Eloquent\Model $Model;

    public function __construct()
    {
        $this->Model = new \Backend\Modules\PayHub\Models\AcquiringResponse();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection($this->Model->getConnectionName())->create($this->Model->getTable(), function (Blueprint $table) {
            $table->id();

            $table->string($this->Model->getHashColumn(), 75)->unique();
            $table->string($this->Model->getTransactionIdColumn(), 100)->unique();
            $table->string($this->Model->getTransactionIdColumn(), 100)->nullable();
            $table->string($this->Model->getSystemNameColumn(), 20);
            $table->float($this->Model->getAmountColumn())->default(0);
            $table->text($this->Model->getResponseDataColumn());

            $table->timestamp($this->Model->getCreatedAtColumn())->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp($this->Model->getUpdatedAtColumn())->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection($this->Model->getConnectionName())->dropIfExists($this->Model->getTable());
    }
}
