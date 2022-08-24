<?php

namespace Frontend\Queries\Pages;

use Illuminate\Database\Eloquent\Builder;

class PagesQuery extends Builder
{

    /**
     * @param $id
     * @return $this
     */
    public function search(): PagesQuery
    {

        if( app('request')->has('q') )
        {

            $currentLocale = app()->getLocale();

            return $this->where('name->' . $currentLocale, 'LIKE', '%'.app('request')->q.'%');

        }else{

            return $this->where('id', '<', '0');

        }


    }

}
