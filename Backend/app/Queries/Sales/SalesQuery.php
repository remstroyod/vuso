<?php

namespace Backend\Queries\Sales;

use Illuminate\Database\Eloquent\Builder;

class SalesQuery extends Builder
{

    /**
     * @param $id
     * @return $this
     */
    public function whereNotCurrentId($id): SalesQuery
    {

        $this->whereNotIn('id', [$id]);

        return $this;
    }

}
