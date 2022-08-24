<?php

namespace Backend\Queries;

use Backend\Enums\PagesTypeEnum;
use Illuminate\Database\Eloquent\Builder;

class PagesQuery extends Builder
{

    /**
     * @param string $status
     */
    public function whereConstructor(): self
    {
        $this->where('type', PagesTypeEnum::constructor);

        return $this;
    }

    /**
     * @param string $status
     */
    public function whereStatic(): self
    {
        $this->whereIn('type', [PagesTypeEnum::static, PagesTypeEnum::dynamic]);

        return $this;
    }

    /**
     * @param string $status
     */
    public function wherePagesTree(): self
    {
        $this->whereNull('parent_id')->with('childrenPages');

        return $this;
    }

}
