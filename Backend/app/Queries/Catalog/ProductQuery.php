<?php

namespace Backend\Queries\Catalog;

use Backend\Enums\CatalogEnum;
use Illuminate\Database\Eloquent\Builder;

class ProductQuery extends Builder
{

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
     * @return $this
     */
    public function whereNotCurrent($id): ProductQuery
    {

        $this->where('id', '!=', $id);

        return $this;
    }

}
