<?php

namespace Backend\Models\Constructor;

use Backend\Queries\Constructor\ConstructorDinamycQuery;
use Backend\Scopes\Constructor\ConstructorDynamicScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class ConstructorDinamic extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

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
     * @var string[]
     */
    protected $fillable = [
        'shortcode_id',
        'page_id',
        'product_id',
        'name',
        'excerpt',
        'description',
        'template',
        'image',
        'type',
        'is_active',
        'shortcode',
        'published_at',
        'icon',
        'source',
        'url_one',
        'url_two',
        'url_one_title',
        'url_two_title',
    ];

    /**
     * @param $query
     * @return ConstructorDinamycQuery
     */
    public function newEloquentBuilder($query): ConstructorDinamycQuery
    {

        return new ConstructorDinamycQuery($query);

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new ConstructorDynamicScope());

    }

}
