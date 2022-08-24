<?php

namespace Frontend\Queries\Informations;

use Illuminate\Database\Eloquent\Builder;

class InformationsQuery extends Builder
{

    /**
     * @param $id
     * @return $this
     */
    public function search(): InformationsQuery
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
