<?php

namespace Frontend\Models;

use Frontend\Models\Blocks\Block;
use Frontend\Models\Faq\Faq;
use Frontend\Presenters\PagesPresenter;
use Frontend\Queries\Pages\PagesQuery;
use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Pages extends Model
{
    use HasTranslations, IsActiveTrait;

    /**
     * @var string
     */
    protected $primaryKey = 'page';
    public $incrementing = false;

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'excerpt',
        'description',
        'content',
    ];

    /**
     * @param $query
     * @return PagesQuery
     */
    public function newEloquentBuilder($query): PagesQuery
    {

        return new PagesQuery($query);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo()
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function faqs()
    {
        return $this->belongsToMany(Faq::class, 'faq_pages', 'pages_page', 'faq_id', 'id', 'id')->where('model', 'page');
    }

    /**
     * @return HasMany
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'page_id', 'id')->whereIn('model', ['page', 'static']);
    }

}
