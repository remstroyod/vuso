<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConstructorShortcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructor_shortcodes', function (Blueprint $table) {

            $table->increments('id');
            $table->string('shortcode')->index()->unique();
            $table->longText('title')->nullable();
            $table->longText('subtitle')->nullable();
            $table->boolean('limit')->nullable();

        });

        $shortcodes = \Backend\Enums\ConstructorDinamycEnum::$ids;
        foreach ($shortcodes as $key => $shortcode) {
            DB::table('constructor_shortcodes')->insert([
                'shortcode' => $key,
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('constructor_shortcodes');
    }

}
