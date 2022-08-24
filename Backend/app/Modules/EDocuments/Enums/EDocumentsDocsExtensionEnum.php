<?php

namespace Backend\Modules\EDocuments\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class EDocumentsDocsExtensionEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::pdf;

    /**
     * Extension Document
     */
    const pdf  = 1;
    const doc  = 2;


    /**
     * Title
     * @var string[]
     */
    public static $name = [
        self::pdf  => '.pdf',
        self::doc  => '.docx',
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
