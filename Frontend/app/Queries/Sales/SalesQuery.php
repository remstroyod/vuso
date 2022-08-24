<?php

namespace Frontend\Queries\Sales;

use Illuminate\Database\Eloquent\Builder;

class SalesQuery extends Builder
{

    /**
     * @param $id
     * @return $this
     */
    public function getLast($count = 3): SalesQuery
    {
        $this->orderBy('id', 'desc')->take($count);

        return $this;
    }

}
