<?php

namespace Frontend\Queries\Articles;

use Illuminate\Database\Eloquent\Builder;

class ArticlesQuery extends Builder
{

    /**
     * @return ArticlesQuery
     */
    public function popular($count = 3): ArticlesQuery
    {

        return $this->where('is_popular', 1)->take($count);

    }

    /**
     * @return ArticlesQuery
     */
    public function lastSales($count = 3): ArticlesQuery
    {

        return $this->where('is_sale', 1)->take($count);

    }

    /**
     * @param $request
     * @return ArticlesQuery
     */
    public function search($request)
    {

        if( app('request')->has('q') )
        {

            $currentLocale = app()->getLocale();

            return $this->where('is_banner', 0)->where('name->' . $currentLocale, 'LIKE', '%'.app('request')->q.'%');

        }else{

            return $this->where('id', '<', '0');

        }

    }

}
