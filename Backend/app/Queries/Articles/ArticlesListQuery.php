<?php

namespace Backend\Queries\Articles;

use Illuminate\Database\Eloquent\Builder;

class ArticlesListQuery extends Builder
{


    /**
     * @param string $status
     */
    public function search($request): ArticlesListQuery
    {

        $currentLocale = app()->getLocale();

        return $this->where(function ($query) use ($request, $currentLocale){

            $request = (object) $request;

            if( isset($request->category) && !empty( $request->category ) )
            {
                $query->where('category_id', $request->category);
            }

            if( isset($request->q) && !empty( $request->q ) )
            {
                $query->where('name->' . $currentLocale, 'LIKE', '%'.$request->q.'%');
            }

        });


    }

}
