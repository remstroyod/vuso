<?php

namespace Backend\Queries\Articles;

use Backend\Enums\FormsEnum;
use Illuminate\Database\Eloquent\Builder;

class CategoriesQuery extends Builder
{

    /**
     * @param string $status
     */
    public function whereCategoriesTree(): self
    {
        $this->whereNull('parent_id')->with('childrenCategories');

        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function whereNotCurrentId($id): CategoriesQuery
    {
        $this->whereNotIn('id', [$id]);

        return $this;
    }

}
