<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class MenuEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::ul;

    /**
     * Type Forms
     */
    const ul    = 1;
    const div   = 2;

    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::ul    => 'Список UL',
        self::div   => 'Обертка DIV',
    ];

    /**
     * @return string[]
     */
    public static function flip()
    {

        return array_flip(self::toArray());

        throw new \LogicException('Missing offer type');
    }

}
