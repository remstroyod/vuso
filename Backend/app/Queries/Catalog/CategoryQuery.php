<?php

namespace Backend\Queries\Catalog;

use Backend\Enums\CatalogEnum;
use Backend\Enums\FormsEnum;
use Illuminate\Database\Eloquent\Builder;

class CategoryQuery extends Builder
{

    /**
     * @param $id
     * @return $this
     */
    public function whereNotCurrentId($id): CategoryQuery
    {

        $this->whereNotIn('id', [$id]);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereDefault(): CategoryQuery
    {

        $this->where('type', CatalogEnum::default);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereB2B(): CategoryQuery
    {

        $this->where('type', CatalogEnum::b2b);

        return $this;
    }

}
