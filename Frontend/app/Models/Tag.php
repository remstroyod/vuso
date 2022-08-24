<?php

namespace Frontend\Models;

use Frontend\Models\Catalog\Product;
use Frontend\Models\Partners\Partners;
use Frontend\Queries\Tags\TagQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory,
        HasTranslations,
        SoftDeletes;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
    ];

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @param $query
     * @return TagQuery
     */
    public function newEloquentBuilder($query): TagQuery
    {

        return new TagQuery($query);

    }

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {

        return $this->belongsToMany(Product::class, 'pages_tags', 'tag_id', 'pages_id');

    }

}
