<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class CatalogEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::default;

    /**
     * Type Catalog
     */
    const default           = 1;
    const b2b               = 2;

    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::default    => 'Стандартный',
        self::b2b       => 'B2B',
    ];

}
