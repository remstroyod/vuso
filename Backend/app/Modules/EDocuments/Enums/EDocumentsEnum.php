<?php

namespace Backend\Modules\EDocuments\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class EDocumentsEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::static;

    /**
     * Extension Document
     */
    const static  = 1; // Дефолтный тип документа, который нельзя удалить.
    const dynamic = 2; // Тип, который создается пользователями

    /**
     * @var string[]
     */
    public static $use = [
        1 => 'Одинаковый для всех',
        2 => 'Динамический',
    ];

}
