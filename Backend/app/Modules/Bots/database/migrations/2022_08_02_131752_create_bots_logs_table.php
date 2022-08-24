<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBotsLogsTable extends Migration
{
    private \Backend\Modules\Bots\Models\Log $Model;

    public function __construct()
    {
        $this->Model = new \Backend\Modules\Bots\Models\Log();
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->Model->getTable(), function (Blueprint $table) {
            $table->id();

            $table->text('message')->nullable();
            $table->string('bot_type', 50);
            $table->enum('type', \Backend\Enums\LogTypesEnum::$types)->default(\Backend\Enums\LogTypesEnum::TYPE_ERROR);
            $table->unsignedSmallInteger('line')->default(0);
            $table->string('file')->nullable();

            $table->timestamp($this->Model->getCreatedAtColumn())
                ->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp($this->Model->getUpdatedAtColumn())
                ->default(\Illuminate\Support\Facades\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
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

