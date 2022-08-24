<?php

namespace Frontend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class ProvidersEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::google;

    /**
     * Providers
     */
    const google       = 'Google';
    //const apple        = 'Apple ID';
    const facebook     = 'Facebook';
    //const telegram     = 'Telegram';

}
