<?php

namespace Backend\Presenters\Articles;

use Illuminate\Support\Str;
use McCool\LaravelAutoPresenter\BasePresenter;
use Rolandstarke\Thumbnail\Thumbnail;

class ArticlesPresenter extends BasePresenter
{

    protected $out = [];

    protected $thumbnail;

    protected $extension = '';

    public function __construct(Thumbnail $thumbnail)
    {
        /**
         * Thumbnail
         */
        $this->thumbnail = $thumbnail;

        /**
         * Set Parent Directory
         */
        $this->out[] = 'blog';

    }

    /**
     * @param $categories
     * @return string
     */
    public function getFullUrl(): string
    {

        if( $this->category )
            $this->out[] = $this->category->slug;

        $this->out[] = $this->slug;

        return localeUrl() . implode('/', $this->out) . $this->extension;

    }

    /**
     * @param $categories
     * @return string
     */
    public function getThumbnail(): string
    {

        return Str::of($this->thumbnail->src('/images/articles/' . $this->image, 'public')->smartcrop(70, 70)->url())->replace('//storage', '/storage');

    }

}
