<?php

namespace Backend\Queries\PaymentDelivery;

use Illuminate\Database\Eloquent\Builder;

class CategoriesQuery extends Builder
{

    /**
     * @param string $status
     */
    public function whereParents(): self
    {
        $this->whereNull('parent_id');

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

    /**
     * @param string $status
     */
    public function whereNotCurrent($model): self
    {

        $this->where('id', '!=', $model->id);

        return $this;

    }

}
