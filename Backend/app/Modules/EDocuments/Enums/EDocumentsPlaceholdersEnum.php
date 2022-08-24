<?php

namespace Backend\Modules\EDocuments\Enums;

use Jenssegers\Date\Date;
use MadWeb\Enum\Enum;

/**
 * @method static
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class EDocumentsPlaceholdersEnum extends Enum
{

    /**
     * Default
     */
    const __default = self::date;

    const date      = 'Дата';
    const year      = 'Год';
    const day       = 'День';
    const month     = 'Месяц';


    /**
     * @return array
     */
    public static function labels(): array
    {

        $result = [
            'date'  => Date::now()->format('d.m.Y'),
            'year'  => Date::now()->format('Y'),
            'day'   => Date::now()->format('d'),
            'month' => Date::now()->format('m'),
        ];

        return $result;
    }

    /**
     * @return array
     */
    public static function complete(): array
    {

        $result = [];
        $arr = self::toArray();
        $labels = self::labels();

        foreach ( $arr as $key => $value )
        {

            $result[] = (object) [
                'slug' => $key,
                'name' => $value,
                'value' => $labels[$key],
            ];

        }

        return $result;

    }


}
