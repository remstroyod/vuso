<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

class LogTypesEnum extends Enum
{
    const TYPE_INFO     = 'info';
    const TYPE_LOG      = 'log';
    const TYPE_DEBUG    = 'debug';
    const TYPE_WARNING  = 'warning';
    const TYPE_ERROR    = 'error';

    public static array $types = [
        self::TYPE_INFO, self::TYPE_LOG, self::TYPE_DEBUG,
            self::TYPE_WARNING, self::TYPE_ERROR
    ];
}