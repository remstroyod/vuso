<?php

namespace Frontend\Models\Catalog;

use Backend\Enums\CatalogEnum;
use Frontend\Models\Seo;
use Frontend\Models\Tag;
use Frontend\Models\Payhub\PayHubSystem;
use Frontend\Presenters\Catalog\ProductPresenter;
use Frontend\Queries\Catalog\ProductQuery;
use Frontend\Scopes\Catalog\ProductsScope;
use Frontend\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements HasPresenter
{

    use HasFactory, HasTranslations, SoftDeletes;

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
    public $translatable = [
        'name',
        'short_name',
        'doc_name_1c',
        'description',
        'excerpt',
        'scenario',
        'content',
    ];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return ProductPresenter::class;
    }

    /**
     * @return BelongsTo
     */
    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function payHub()
    {
        return $this->hasOne(PayHubSystem::class, 'id', 'payhub_id');
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @param $query
     * @return ProductQuery
     */
    public function newEloquentBuilder($query): ProductQuery
    {

        return new ProductQuery($query);

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        // static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new ProductsScope());

    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {

        return $this->belongsToMany(Tag::class, 'pages_tags', 'pages_id')->where('type', CatalogEnum::b2b);

    }

    /**
     * @return Collection
     */
    public function getTagsProducts(): Collection
    {

        $collection = new Collection();
        $products = $this->whereB2B()->get();

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
