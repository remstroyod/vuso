<?php

namespace Backend\Modules\PayHub\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class PayHubPaymentStatusEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::nopaid;

    /**
     * Source
     */
    const nopaid  = 0;
    const paid  = 1;
    const errorpaid  = 2;

    /**
     * @var string[]
     */
    public static $name = [
        self::nopaid  => 'Не оплачен',
        self::paid  => 'Оплачен',
        self::errorpaid  => 'Ошибка оплаты',
    ];

}
