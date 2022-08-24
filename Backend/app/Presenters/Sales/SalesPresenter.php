<?php

namespace Backend\Presenters\Sales;

use Illuminate\Support\Str;
use McCool\LaravelAutoPresenter\BasePresenter;
use Rolandstarke\Thumbnail\Thumbnail;

class SalesPresenter extends BasePresenter
{

    protected $thumbnail;

    public function __construct(Thumbnail $thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @param $categories
     * @return string
     */
    public function getThumbnail(): string
    {

        return Str::of($this->thumbnail->src('/images/sales/' . $this->image, 'public')->smartcrop(70, 70)->url())->replace('//storage', '/storage');

    }

}
