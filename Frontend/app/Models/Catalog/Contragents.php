<?php

namespace Frontend\Models\Catalog;

use Frontend\Queries\Catalog\ContragentsQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\Translatable\HasTranslations;

class Contragents extends Model
{

    use HasTranslations, SoftDeletes;
    /**
     * @var string
     */
    protected $table = 'category_types';

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
    ];

    /**
     * @param $query
     * @return ContragentsQuery
     */
    public function newEloquentBuilder($query): ContragentsQuery
    {

        return new ContragentsQuery($query);

    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return HasMany
     */
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'category_type_id', 'id');
    }

    /**
     * @return Collection
     */
    public function tagsByContragent(): Collection
    {

        $collection = new Collection();
        $categories = $this->categories;

        if( $categories->count() )
        {
            foreach ( $categories as $category )
            {

                $products = $category->products;

                if( $products )
                {
                    foreach ( $products as $product )
                    {
                        $tags = $product->tags()->whereProducts()->get()->pluck('id', 'name')->toArray();
                        $collection = $collection->merge($tags);
                    }
                }

            }
        }

        return $collection;

    }

}
