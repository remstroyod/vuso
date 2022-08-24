<?php

namespace Backend\Models\Catalog;

use Backend\Models\Seo;
use Backend\Models\Tag;
use Backend\Modules\EDocuments\Models\EDocumentsDocs;
use Backend\Modules\PayHub\Models\PayHubSystem;
use Backend\Presenters\Catalog\ProductsPresenter;
use Backend\Queries\Catalog\ProductQuery;
use Backend\Scopes\Catalog\ProductsScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

/**
 * @property string $name
 *
 * @property PayHubSystem $payhub
 */
class Product extends Model implements hasPresenter
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
        'content',
        'scenario',
        'text',
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
        'payhub_id',
        'name',
        'doc_name_1c',
        'doc_id_1c',
        'short_name',
        'description',
        'excerpt',
        'image',
        'icon_svg',
        'slug',
        'scenario',
        'content',
        'is_active',
        'is_popular',
        'is_header',
        'is_footer',
        'type',
        'token',
        'order',
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
     * @param $query
     * @return ProductQuery
     */
    public function newEloquentBuilder($query): ProductQuery
    {

        return new ProductQuery($query);

    }

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return ProductsPresenter::class;
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function documents(): BelongsToMany
    {
        return $this->belongsToMany(EDocumentsDocs::class, 'edocuments_products', 'product_id', 'document_id', 'id', 'id');
    }


    /**
     * @param $type
     * @return BelongsToMany
     */
    public function document($type): BelongsToMany
    {
        return $this->belongsToMany(EDocumentsDocs::class, 'edocuments_products', 'product_id', 'document_id', 'id', 'id')->where('type_id', '=', $type);
    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {

        return $this->belongsToMany(Tag::class, 'pages_tags', 'pages_id');

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new ProductsScope());

    }

    /**
     * @return BelongsToMany
     */
    public function relevant(): BelongsToMany
    {

        return $this->belongsToMany(self::class, 'product_product', 'product_id', 'product_relevant_id', 'id', 'id');

    }

    /**
     * @return BelongsTo
     */
    public function payhub(): BelongsTo
    {
        return $this->belongsTo(PayHubSystem::class, 'payhub_id', 'id');
    }

}
