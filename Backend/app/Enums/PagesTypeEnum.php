<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class PagesTypeEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::static;

    /**
     * Type Page
     */
    const static       = 1;
    const constructor  = 2;
    const dynamic      = 3;

    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::static       => 'Предопределенная',
        self::constructor  => 'Конструктор',
        self::dynamic      => 'Статическая',
    ];

    /**
     * @param $type
     * @return string
     */
    public static function type($type)
    {

        if ( isset(self::$name[$type]) )
            return __( self::$name[$type] );

        throw new \LogicException('Missing offer type');
    }

}
