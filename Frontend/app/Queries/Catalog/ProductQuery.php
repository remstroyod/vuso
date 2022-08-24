<?php

namespace Frontend\Queries\Catalog;

use Backend\Enums\CatalogEnum;
use Illuminate\Database\Eloquent\Builder;

class ProductQuery extends Builder
{

    /**
     * @param $id
     * @return $this
     */
    public function search(): ProductQuery
    {

        if( app('request')->has('q') )
        {
            $currentLocale = app()->getLocale();

            return $this->where('name->' . $currentLocale, 'LIKE', '%'.app('request')->q.'%');

        }else{

            return $this->where('id', '<', '0');

        }

    }

    /**
     * @return ProductQuery
     */
    public function popular($count = 3): ProductQuery
    {

        return $this->where('is_popular', 1)->take($count);

    }

    /**
     * @return $this
     */
    public function whereDefault(): ProductQuery
    {

        $this->where('type', CatalogEnum::default);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereB2B(): ProductQuery
    {

        $this->where('type', CatalogEnum::b2b);

        return $this;
    }

    /**
     * @param $request
     * @return $this
     */
    public function whereTags($request = []): ProductQuery
    {

        if( $request )
        {
            $this->whereHas('tags', function ($q) use ($request)
            {
                $q->whereIn('id', $request);
            });
        }

        return $this;

    }

    /**
     * @param $contragents
     * @return $this
     */
    public function whereCategories($contragents = []): ProductQuery
    {

        $this->whereHas('categories', function($query) use ($contragents)
        {
            $query->where('category_type_id', $contragents->id);
        });

        return $this;

    }

    public function getTagsByCategory($request = []): ProductQuery
    {

        return $this;

    }

}
