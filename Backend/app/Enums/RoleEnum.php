<?php

namespace Backend\Enums;

use LogicException;
use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class RoleEnum extends Enum
{

    /**
     * Default
     */
    public const __default = self::admin;

    /**
     * Type Forms
     */
    public const admin = 1;
    public const manager = 2;
    public const guest = 3;

    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::admin => 'Admin',
        self::manager => 'Manager',
        self::guest => 'Guest',
    ];

    /**
     * @var string[]
     */
    public static $list = [
        'admin' => 'Admin',
        'manager' => 'Manager',
        'guest' => 'Guest',
    ];

    /**
     * @param $type
     * @return string
     */
    public static function type($type): string
    {
        if (isset(self::$name[$type])) {
            return __(self::$name[$type]);
        }

        throw new LogicException('Missing offer type');
    }

    /**
     * @param $type
     * @return bool
     */
    public static function isArray($type): bool
    {
        return array_key_exists($type, parent::toArray()) ? true : false;
    }

}
