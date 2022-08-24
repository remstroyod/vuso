<?php

namespace Frontend\Presenters\Catalog;

use Illuminate\Support\Facades\Storage;
use McCool\LaravelAutoPresenter\BasePresenter;

class ProductPresenter extends BasePresenter
{

    public function __construct()
    {


    }

    /**
     * @return string
     */
    public function getProductUrl(): string
    {

        return route('catalog.product.index', ['product' => $this]);

    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {

        if( $this->image )
            return Storage::url('images/catalog/products/' . $this->image);

        return '';

    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->categories->first();
    }



}
