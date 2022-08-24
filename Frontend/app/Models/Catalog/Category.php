<?php

namespace Frontend\Models\Catalog;

use Backend\Models\Seo;
use Frontend\Models\Blocks\Block;
use Frontend\Models\Faq\Faq;
use Frontend\Queries\Catalog\CategoryQuery;
use Frontend\Scopes\Catalog\CategoriesScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{

    use HasTranslations, SoftDeletes;

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
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return HasOne
     */
    public function contragent(): HasOne
    {
        return $this->hasOne(Contragents::class, 'id', 'category_type_id');
    }

    /**
     * @return BelongsTo
     */
    public function seo(): BelongsTo
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

    /**
     * @return Collection
     */
    public function tagsByCategory(): Collection
    {

        $collection = new Collection();
        $products = $this->products()->get();

        if( $products )
        {
            foreach ( $products as $product )
            {
                $tags = $product->tags()->whereProducts()->get()->pluck('id', 'name')->toArray();
                $collection = $collection->merge($tags);
            }
        }

        return $collection;

    }

}
