<?php

namespace Backend\Scopes\Constructor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Scope;

class ConstructorDynamicScope implements Scope
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

        if( request()->routeIs('b2b.constructor.dinamyc.*') )
        {
            $builder->where('product_id', request()->product->id);
        }

    }

}
