<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class FormsEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::reviews;

    /**
     * Type Forms
     */
    const reviews           = 1;
    const consultation      = 2;
    const feedback          = 3;
    const question          = 4;
    const faq               = 5;
    const partners          = 6;
    const support           = 7;
    const subscribe         = 8;
    const payment           = 9;
    const request           = 10;
    const messenger         = 11;
    const add_contract      = 12;


    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::reviews       => 'Отзывы',
        self::consultation  => 'Консультация',
        self::feedback      => 'Обратная связь',
        self::question      => 'Вопрос',
        self::faq           => 'Вопросы и ответы',
        self::partners      => 'Стать партнером',
        self::support       => 'Поддержка',
        self::subscribe     => 'Подписка',
        self::payment       => 'Оплата в офисе',
        self::request       => 'Запрос',
        self::messenger     => 'messanger',
        self::add_contract  => 'add_contract',
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
