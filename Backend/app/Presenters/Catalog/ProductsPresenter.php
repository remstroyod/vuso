<?php

namespace Backend\Presenters\Catalog;

use McCool\LaravelAutoPresenter\BasePresenter;

class ProductsPresenter extends BasePresenter
{

    protected $extension = '';

    public function __construct()
    {

    }

    /**
     * @param $model
     * @return string
     */
    public function getCategoriesAll(): string
    {

        return $this->categories->implode('name', ', ');

    }

    /**
     * @param $categories
     * @return string
     */
    public function getFullUrl(): string
    {
        
        $url = null;

        if( request()->routeIs('catalog.products.edit') )
        {

            $url = localeUrl() . 'product/' . $this->slug . $this->extension;

        }elseif ( request()->routeIs('b2b.products.edit') )
        {

            $url = localeUrl() . 'b2b/product/' . $this->categories->first()->slug . '/' . $this->slug . $this->extension;

        }

        return $url;

    }

}
