<?php

namespace Backend\Models\Sales;

use Backend\Models\Seo;
use Backend\Presenters\Sales\SalesPresenter;
use Backend\Scopes\Sales\SalesScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Sales extends Model implements HasPresenter
{
    use HasFactory,
        SoftDeletes,
        HasTranslations,
        Sluggable;

    /**
     * @var string
     */
    protected $table = 'sales';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'excerpt', 'description'];

    /**
     * @var string[]
     */
    protected $casts = [
        'date_end' => 'datetime:Y-m-d', // Change your format
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
        'category_id',
        'seo_id',
        'name',
        'image',
        'excerpt',
        'date_end',
        'description',
        'file',
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
     * @return string
     */
    public function getPresenterClass(): string
    {
        return SalesPresenter::class;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo()
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new SalesScope());

    }

}
