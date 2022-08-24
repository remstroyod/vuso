<?php

namespace Frontend\Presenters\Articles;

use McCool\LaravelAutoPresenter\BasePresenter;

class ArticlesPresenter extends BasePresenter
{

    public function __construct()
    {

    }

    /**
     * @param $categories
     * @return string
     */
    public function completeTitle(): string
    {

        $title = '';

        if( isset($this->seo->title) ) :
            $title =(!empty($this->seo->title)) ? $this->seo->title : $this->name;
        else :
            $title = $this->name;
        endif;

        return $title;

    }

}
