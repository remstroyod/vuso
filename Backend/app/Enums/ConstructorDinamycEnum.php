<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class ConstructorDinamycEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::faq;

    /**
     * Type Shortcode
     */
    const faq = 1;
    const reviews = 2;
    const offerproduct = 3;
    const sales = 4;
    const productsinsale = 5;
    const faqsale = 6;
    const video = 7;
    const compare = 8;
    const subscribe = 9;
    const support = 10;
    const faqform = 11;
    const consultationphone = 12;
    const consultationemail = 13;
    const partner = 14;

    /**
     * Title
     * @var string[]
     */
    public static $name = [
        'faq' => 'Вопросы и ответы',
        'reviews' => 'Блок отзывов и форма «Оставить отзыв»',
        'offerproduct' => '4.9 - Блок «Предлагаем вам продукт»',
        'sales' => 'Акции',
        'productsinsale' => '4.12 - Блок «Продукты учавствующие в акции»',
        'faqsale' => '4.16 - Блок «Вопросы и ответы с акцией»',
        'video' => '4.3 - Блок с видео',
        'compare' => '4.7 - Блок «Стравнение страховых полисов»',
        'subscribe' => '4.17 - Блок Подписаться на email-рассылку',
        'support' => '5.3 - Блок ЧаВо и форма «Задать вопрос»',
        'faqform' => '5.4 - Блок одиночная форма «Задать вопрос»',
        'consultationphone' => '5.6 - Блок «Заказ консультации через телефон»',
        'consultationemail' => '5.7 - Блок «Заказ консультации через email»',
        'partner' => '5.8 - Блок «Стать партнёром»',
    ];

    public static $ids = [
        'faq' => self::faq,
        'reviews' => self::reviews,
        'offerproduct' => self::offerproduct,
        'sales' => self::sales,
        'productsinsale' => self::productsinsale,
        'faqsale' => self::faqsale,
        'video' => self::video,
        'compare' => self::compare,
        'subscribe' => self::subscribe,
        'support' => self::support,
        'faqform' => self::faqform,
        'consultationphone' => self::consultationphone,
        'consultationemail' => self::consultationemail,
        'partner' => self::partner,
    ];

}
