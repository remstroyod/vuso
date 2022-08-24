<?php

namespace Frontend\Models\Articles;

use Frontend\Models\Seo;
use Frontend\Presenters\Articles\ArticlesPresenter;
use Frontend\Queries\Articles\ArticlesQuery;
use Frontend\Scopes\Articles\ArticlesScope;
use Frontend\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Articles extends Model implements hasPresenter
{

    use HasTranslations, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'articles';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'description',
        'excerpt',
    ];

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return ArticlesPresenter::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo()
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category() {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new ArticlesScope());
    }

    /**
     * @param $query
     * @return ArticlesQuery
     */
    public function newEloquentBuilder($query): ArticlesQuery
    {

        return new ArticlesQuery($query);

    }

}
