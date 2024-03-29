<?php

namespace Frontend\Queries\Catalog;

use Backend\Enums\CatalogEnum;
use Illuminate\Database\Eloquent\Builder;

class ContragentsQuery extends Builder
{

    /**
     * @return $this
     */
    public function whereDefault(): ContragentsQuery
    {

        $this->where('type', CatalogEnum::default);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereB2B(): ContragentsQuery
    {

        $this->where('type', CatalogEnum::b2b);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereAttach(): ContragentsQuery
    {

        $this->where('is_attach', 1);

        return $this;
    }

}
