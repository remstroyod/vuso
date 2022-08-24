<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class PromocodeTypeEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::promocode;

    /**
     * Type
     */
    const promocode     = 1;
    const coupon        = 2;

    /**
     * @var string[]
     * Frontend Slug
     */
    public static $name = [
        self::promocode     => 'Промокод',
        self::coupon        => 'Купон',
    ];

}
