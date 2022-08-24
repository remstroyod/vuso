<?php

namespace Backend\Queries\Forms\Data;

use Backend\Enums\FormsEnum;
use Illuminate\Database\Eloquent\Builder;

class FormsDataQuery extends Builder
{

    /**
     * @param string $status
     */
    public function whereReviews(): self
    {
        $this->where('type', FormsEnum::reviews);

        return $this;
    }

    /**
     * @param string $status
     */
    public function whereFeedback(): self
    {
        $this->where('type', FormsEnum::feedback);

        return $this;
    }

    /**
     * @param string $status
     */
    public function search($request): FormsDataQuery
    {

        $currentLocale = app()->getLocale();

        return $this->where(function ($query) use ($request, $currentLocale){

            $request = (object) $request;

            if( isset($request->type) && !empty( $request->type ) )
            {
                $query->where('type', $request->type);
            }

            if( isset($request->q) && !empty( $request->q ) )
            {
                $query->where('name->' . $currentLocale, 'LIKE', '%'.$request->q.'%');
            }

        });


    }

}
