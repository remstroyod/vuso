<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class PromocodeStatusEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::active;

    /**
     * Status
     */
    const active     = 1;
    const expired    = 2;

    /**
     * @var string[]
     * Frontend Slug
     */
    public static $name = [
        self::active     => 'Активный',
        self::expired    => 'Истек',
    ];

    public static $class = [
        self::active     => 'badge-success',
        self::expired    => 'badge-dark',
    ];

    /**
     * @param $type
     * @return string
     */
    public function name($status)
    {

        if ( isset(self::$name[$status]) )
            return __( self::$name[$status] );

        throw new \LogicException('Missing offer type');
    }

    /**
     * @param $status
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Translation\Translator|string|null
     */
    public function class($status)
    {

        if ( isset(self::$class[$status]) )
            return __( self::$class[$status] );

        throw new \LogicException('Missing offer type');
    }

    /**
     * @return string[]
     */
    public function list()
    {

        return self::$name;

        throw new \LogicException('Missing offer type');
    }

}
