<?php

namespace Backend\Models\Ecommerce;

use Backend\Models\Catalog\Product;
use Backend\Presenters\Ecommerce\PromocodePresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Promocode extends Model implements hasPresenter
{

    use HasFactory, HasTranslations;

    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = [
        'expires_at'
    ];

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'code',
        'reward',
        'quantity',
        'data',
        'description',
        'is_disposable',
        'expires_at'
    ];

    protected $casts = [
        'data' => 'object'
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'promocode_only_products');
    }

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return PromocodePresenter::class;
    }
}
