<?php

namespace Backend\Facades;

use Illuminate\Support\Facades\Facade;

class Menu extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'menu';
    }
}
