<?php

namespace Backend\Presenters;

use Backend\Enums\PagesEnum;
use Backend\Enums\PagesTypeEnum;
use McCool\LaravelAutoPresenter\BasePresenter;

class PagesPresenter extends BasePresenter
{

    /**
     * @var string
     */
    protected $parent = 'landing-page';

    public function __construct()
    {

    }

    /**
     * @param $categories
     * @return string
     */
    public function getPreviewUrl(): string
    {   

        $slug = PagesEnum::$slug;
        $slug = (array_key_exists($this->page, $slug)) ? $slug[$this->page] : $this->page;

        $parent = $this->type == PagesTypeEnum::dynamic ? 's/' : $this->parent . '/';
        $url = ($this->type == 1) ? localeUrl() . $slug : localeUrl() . $parent . $slug;
        
        if( request()->routeIs('articles.edit') ){
            
            $url = localeUrl() . 'blog' . '/' . $slug;
        
        }
        return $url;

    }

}
