<?php

namespace Backend\Models\Sales;

use Backend\Models\Seo;
use Backend\Queries\Sales\SalesQuery;
use Backend\Scopes\Sales\CategoriesScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations,
        Sluggable;

    /**
     * @var string
     */
    protected $table = 'sales_categories';

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
        'is_active'
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @param $query
     * @return SalesQuery
     */
    public function newEloquentBuilder($query): SalesQuery
    {

        return new SalesQuery($query);

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new CategoriesScope());

    }

}
