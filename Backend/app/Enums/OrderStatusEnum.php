<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class OrderStatusEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::processing;

    /**
     * Status
     */
    const pending       = 1;
    const processing    = 2;
    const hold          = 3;
    const completed     = 4;
    const cancelled     = 5;
    const refunded      = 6;
    const failed        = 7;
    const paid          = 8;

    /**
     * @var string[]
     * Frontend Slug
     */
    public static $name = [
        self::pending       => 'В ожидании оплаты',
        self::processing    => 'Обработка',
        self::hold          => 'На удержании',
        self::completed     => 'Выполнен',
        self::cancelled     => 'Отменен',
        self::refunded      => 'Возвращён',
        self::failed        => 'Не удался',
        self::paid          => 'Оплачен',
    ];

    public static $class = [
        self::pending       => 'badge-info-muted',
        self::processing    => 'badge-primary',
        self::hold          => 'badge-light',
        self::completed     => 'badge-success',
        self::cancelled     => 'badge-dark',
        self::refunded      => 'badge-secondary',
        self::failed        => 'badge-warning',
        self::paid          => 'badge-info',
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
