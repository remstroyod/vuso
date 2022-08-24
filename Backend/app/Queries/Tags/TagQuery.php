<?php

namespace Backend\Queries\Tags;

use Backend\Enums\CatalogEnum;
use Backend\Enums\TagsEnum;
use Illuminate\Database\Eloquent\Builder;

class TagQuery extends Builder
{

    /**
     * @return $this
     */
    public function wherePages(): TagQuery
    {

        $this->where('type', TagsEnum::page);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereProducts(): TagQuery
    {

        $this->where('type', TagsEnum::product);

        return $this;
    }

    /**
     * @return $this
     */
    public function whereCategoryProducts(): TagQuery
    {

        $this->where('type', TagsEnum::productcategory);

        return $this;
    }

}
