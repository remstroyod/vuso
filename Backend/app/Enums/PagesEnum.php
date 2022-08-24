<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class PagesEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::home;

    /**
     * Pages Default
     */
    const about             = 'about';
    const partners          = 'partners';
    const informations      = 'informations';
    const sales             = 'sales';
    const reviews           = 'reviews';
    const faq               = 'faq';
    const contacts          = 'contacts';
    const articles          = 'articles';
    const support           = 'support';
    const payment_delivery  = 'payment_delivery';
    const home              = 'home';
    const catalog           = 'catalog';
    const search            = 'search';
    const profile           = 'profile';
    const b2b               = 'B2B';
    const payment           = 'payment';

    /**
     * @var string[]
     * Frontend Slug
     */
    public static $slug = [
        self::about             => 'about',
        self::partners          => 'partners',
        self::informations      => 'informations',
        self::sales             => 'sales',
        self::reviews           => 'reviews',
        self::faq               => 'faq',
        self::contacts          => 'contacts',
        self::articles          => 'news',
        self::support           => 'support',
        self::payment_delivery  => 'payments-delivery',
        self::home              => 'index',
        self::catalog           => 'catalog',
        self::search            => 'search',
        self::profile           => 'profile',
        self::b2b               => 'b2b',
        self::payment           => 'payment',
    ];

    /**
     * @param $type
     * @return bool
     */
    public static function isArray($type): bool
    {

        return array_key_exists($type, parent::labels()) ? true : false;

    }

}
