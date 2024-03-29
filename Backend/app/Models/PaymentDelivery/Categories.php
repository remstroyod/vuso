<?php

namespace Backend\Models\PaymentDelivery;

use Backend\Models\Seo;
use Backend\Queries\PaymentDelivery\CategoriesQuery;
use Backend\Scopes\PaymentDelivery\CategoriesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'payment_delivery_categories';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'description'];

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
    protected $fillable = ['parent_id', 'seo_id', 'name', 'description', 'is_active'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function parents(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Categories::class, 'parent_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function childrenCategories(): HasMany
    {
        return$this->hasMany(Categories::class, 'parent_id', 'id')->with('categories');
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
     * @param $query
     * @return CategoriesQuery
     */
    public function newEloquentBuilder($query)
    {

        return new CategoriesQuery($query);

    }
}
