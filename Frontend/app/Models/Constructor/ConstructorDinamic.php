<?php

namespace Frontend\Models\Constructor;

use Frontend\Queries\Constructor\ConstructorDinamycQuery;
use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ConstructorDinamic extends Model
{
    use HasFactory,
        HasTranslations,
        IsActiveTrait,
        SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'constructor_shortcodes_dinamyc';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'excerpt',
        'description',
        'template',
        'name',
        'excerpt',
        'description',
        'url_one_title',
        'url_two_title',
        'url_one',
        'url_two',
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
     * @param $query
     * @return ConstructorDinamycQuery
     */
    public function newEloquentBuilder($query): ConstructorDinamycQuery
    {

        return new ConstructorDinamycQuery($query);

    }

}
