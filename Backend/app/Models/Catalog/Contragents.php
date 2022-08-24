<?php

namespace Backend\Models\Catalog;

use Backend\Queries\Catalog\ContragentsQuery;
use Backend\Scopes\Catalog\ContragentsScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Contragents extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations,
        Sluggable;

    /**
     * @var string
     */
    protected $table = 'category_types';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
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
        'name',
        'excerpt',
        'slug',
        'is_attach',
        'type',
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
     * @return ContragentsQuery
     */
    public function newEloquentBuilder($query): ContragentsQuery
    {

        return new ContragentsQuery($query);

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new ContragentsScope());

    }

}
