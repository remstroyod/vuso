<?php

namespace Backend\Models\Articles;

use Backend\Models\Seo;
use Backend\Presenters\Articles\ArticlesPresenter;
use Backend\Queries\Articles\ArticlesListQuery;
use Backend\Queries\Articles\ArticlesQuery;
use Backend\Scopes\Articles\ArticlesScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Articles extends Model implements HasPresenter
{
    use HasFactory,
        SoftDeletes,
        Sluggable,
        HasTranslations;

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
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'category_id',
        'seo_id',
        'name',
        'image',
        'slug',
        'order',
        'is_banner',
        'is_sale',
        'excerpt',
        'description',
        'is_active',
        'is_popular',
        'is_header',
        'is_footer',
        'published_at',
    ];

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return ArticlesPresenter::class;
    }

    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo()
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @param $query
     * @return ArticlesListQuery
     */
    public function newEloquentBuilder($query): ArticlesListQuery
    {

        return new ArticlesListQuery($query);

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new ArticlesScope());

    }

}
