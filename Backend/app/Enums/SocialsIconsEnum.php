<?php

namespace Backend\Enums;

use MadWeb\Enum\Enum;

/**
 * @method static SocialsIconsEnum FOO()
 * https://awesomeopensource.com/project/mad-web/laravel-enum
 */
final class SocialsIconsEnum extends Enum
{

    const __default = self::facebook;

    const facebook = 'facebook';
    const instagram = 'instagram';
    const twitter = 'twitter';
    const github = 'github';
    const gitlab = 'gitlab';
    const youtube = 'youtube';

}
