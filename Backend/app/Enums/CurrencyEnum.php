<?php

namespace Backend\Enums;
use MadWeb\Enum\Enum;

/**
 * @method static CurrencyEnum FOO()
 * @method static CurrencyEnum BAR()
 * @method static CurrencyEnum BAZ()
 */
final class CurrencyEnum extends Enum
{
    //const __default = self::usd;

    const usd = 'usd';
    const eur = 'eur';

    public static $name = [
        self::usd  => 'USD',
        self::eur  => 'EUR',
    ];

    public static function name($currency){
        if ( isset(self::$name[$currency]) )
            return self::$name[$currency];

        throw new \LogicException('Missing currency type');
    }
}
