<?php

namespace Backend\Models\Articles;

use Backend\Models\Seo;
use Backend\Presenters\Articles\CategoryPresenter;
use Backend\Queries\Articles\CategoriesQuery;
use Backend\Scopes\Articles\CategoriesScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Categories extends Model implements HasPresenter
{
    use HasFactory,
        SoftDeletes,
        Sluggable,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'articles_categories';

    /**
     * @var string[]
     */
    public $translatable = ['name'];

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
        'parent_id',
        'seo_id',
        'name',
        'slug',
        'is_active',
        'author_id'
    ];

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
     * @return string
     */
    public function getPresenterClass(): string
    {
        return CategoryPresenter::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new CategoriesScope());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function categories()
    {
        return $this->hasMany(Categories::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrenCategories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return$this->hasMany(Categories::class, 'parent_id', 'id')->with('categories');
    }

    /**
     * @param $query
     * @return CategoriesQuery
     */
    public function newEloquentBuilder($query)
    {

        return new CategoriesQuery($query);

    }

}
