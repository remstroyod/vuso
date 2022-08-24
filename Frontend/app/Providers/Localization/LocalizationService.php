<?php

namespace Frontend\Providers\Localization;

use Illuminate\Support\Facades\Facade;

class LocalizationService extends Facade
{

    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return "Localization";
    }
}
