<?php

namespace Backend\Queries\Menu;

use Illuminate\Database\Eloquent\Builder;

class MenuElementsQuery extends Builder
{

    /**
     * @param string $status
     */
    public function whereMenuTree(): self
    {
        $this->whereNull('parent_id')->with('childrenMenu');

        return $this;
    }

}
