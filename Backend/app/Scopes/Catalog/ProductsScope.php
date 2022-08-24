<?php

namespace Backend\Scopes\Catalog;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\DB;

class ProductsScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

        $builder
            ->orderByRaw("CASE WHEN `order` IS NULL THEN 1 ELSE 0 END ASC")
            ->orderBy('order', 'asc')
            ->orderBy('id');

    }

}
