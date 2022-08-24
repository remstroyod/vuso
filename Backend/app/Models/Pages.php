<?php

namespace Backend\Models;

use Backend\Models\Blocks\Block;
use Backend\Models\Faq\Faq;
use Backend\Presenters\PagesPresenter;
use Backend\Queries\PagesQuery;
use Backend\Scopes\PagesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Pages extends Model implements hasPresenter
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'excerpt',
        'description',
        'content',
        'scenario',
    ];

    /**
     * @var string
     */
    protected $primaryKey = 'page';

    /**
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'page',
        'parent_id',
        'seo_id',
        'name',
        'image',
        'video',
        'video_poster',
        'excerpt',
        'description',
        'content',
        'is_header',
        'is_footer',
        'is_template',
        'is_breadcrumbs',
        'is_active',
        'author_id',
        'scenario',
        'type',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class, 'faq_pages', 'pages_page', 'faq_id', 'id', 'id')->where('model', 'page');
    }

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return PagesPresenter::class;
    }


    /**
     * @param $query
     * @return PagesQuery
     */
    public function newEloquentBuilder($query): PagesQuery
    {

        return new PagesQuery($query);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parents(): HasMany
    {
        return $this->hasMany(Pages::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrenPages(): HasMany
    {
        return$this->hasMany(Pages::class, 'parent_id', 'id')->with('parents');
    }

    /**
     * @return HasMany
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'page_id', 'id')->whereIn('model', ['page', 'static']);
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new PagesScope());

    }

}
