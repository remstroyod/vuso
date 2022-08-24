<?php

namespace Frontend\Presenters;

use Backend\Enums\MenuEnum;
use McCool\LaravelAutoPresenter\BasePresenter;

class MenuPresenter extends BasePresenter
{

    /**
     * @return string
     */
    /**
     * @return string
     */
    public function getWrapper(): string
    {

        $wrapper = MenuEnum::flip();

        return $wrapper[$this->wrapper];

    }

}
