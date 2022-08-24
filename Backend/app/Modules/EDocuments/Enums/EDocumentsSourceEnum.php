<?php

namespace Backend\Modules\EDocuments\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class EDocumentsSourceEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::site;

    /**
     * Source
     */
    const site  = 1;
    const api  = 2;

    /**
     * @var string[]
     */
    public static $name = [
        self::site  => 'Сайт',
        self::api  => 'API',
    ];

}
