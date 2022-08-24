<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class TagsEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::page;

    /**
     * Type Tags
     */
    const page              = 1;
    const product           = 2;
    const productcategory   = 3;

    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::page              => 'Страницы',
        self::product           => 'Продукты',
        self::productcategory   => 'Категории продуктов',
    ];

}
