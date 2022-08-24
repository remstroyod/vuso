<?php

namespace Backend\Queries\Informations;

use Backend\Enums\FormsEnum;
use Illuminate\Database\Eloquent\Builder;

class CategoriesQuery extends Builder
{

    /**
     * @param string $status
     */
    public function whereParents(): self
    {
        $this->whereNull('parent_id')->with('childrenCategories');

        return $this;
    }

    /**
     * @param string $status
     */
    public function whereChildrens(): self
    {
        $this->whereNotNull('parent_id');

        return $this;
    }

}
