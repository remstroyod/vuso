<?php

namespace Backend\Models\Catalog;

use Backend\Models\Blocks\Block;
use Backend\Models\Faq\Faq;
use Backend\Models\Seo;
use Backend\Queries\Catalog\CategoryQuery;
use Backend\Scopes\Catalog\CategoriesScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory,
        SoftDeletes,
        Sluggable,
        HasTranslations;

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'short_name',
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
        'parent_id',
        'seo_id',
        'category_type_id',
        'name',
        'short_name',
        'description',
        'excerpt',
        'image',
        'slug',
        'is_active',
        'is_header',
        'is_footer',
        'type',
        'order',
        'icon_image',
        'icon_svg',
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function contragent(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Contragents::class, 'id', 'category_type_id');
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
     * @return CategoryQuery
     */
    public function newEloquentBuilder($query): CategoryQuery
    {

        return new CategoryQuery($query);

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
     * @return HasMany
     */
    public function blocks(): HasMany
    {
        return $this->hasMany(Block::class, 'page_id', 'id')->where('model', 'catalog.category');
    }

    /**
     * @return BelongsToMany
     */
    public function faqs(): BelongsToMany
    {
        return $this->belongsToMany(Faq::class, 'faq_pages', 'pages_page', 'faq_id', 'id', 'id')->where('model', 'catalog.category');
    }

}
