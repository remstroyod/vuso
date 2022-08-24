<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('page')->index()->unique();
            $table->unsignedInteger('seo_id')->nullable();
            $table->longText('name')->nullable(false);
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('video_poster')->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_header')->default(1);
            $table->boolean('is_footer')->default(1);
            $table->boolean('is_template')->default(0);
            $table->boolean('is_breadcrumbs')->default(1);
            $table->boolean('type')->default(1);
            $table->boolean('is_active')->default(1);
            $table->integer('author_id')->references('id')->on('users')->onDelete('CASCADE')->default(1);
            $table->longText('scenario')->nullable();
            $table->dateTime('published_at', 0)->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->softDeletes();

            $table->foreign('parent_id')->references('id')->on('pages')->onDelete('set null');
            $table->foreign('seo_id')->references('id')->on('seo')
                ->onDelete('cascade');

        });

        $pages = \Backend\Enums\PagesEnum::labels();
        foreach ($pages as $page) {
            DB::table('pages')->insert([
                'page' => $page,
                'name' => $page,
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
        Schema::dropIfExists('pages');
    }

    /**
     * Default Static pages
     * @return string[]
     */
//    protected function getDefaultPages()
//    {
//        return [
//            'home',
//            'about',
//            'partners',
//            'informations',
//            'sales',
//            'reviews',
//            'faq',
//            'contacts',
//            'article',
//            'support',
//            'payment_delivery'
//        ];
//    }
}
