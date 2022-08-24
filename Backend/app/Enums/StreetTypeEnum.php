<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class StreetTypeEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::street;

    /**
     * Type Forms
     */
    const street        = 1;
    const avenue        = 2;
    const boulevard     = 3;
    const lane          = 4;
    const impasse       = 5;
    const quay          = 6;
    const vzvoz         = 7;
    const alley         = 8;
    const tract         = 9;


    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::street    => 'Улица',
        self::avenue    => 'Проспект',
        self::boulevard => 'Бульвар',
        self::lane      => 'Переулок',
        self::impasse   => 'Тупик',
        self::quay      => 'Набережная',
        self::vzvoz     => 'Взвоз',
        self::alley     => 'Аллея',
        self::tract     => 'Тракт',
    ];

}
