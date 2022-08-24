<?php

namespace Backend\Modules\Bots;

use MadWeb\Enum\Enum;

class BotTypeEnum extends Enum
{
    const TYPE_TELEGRAM     = 'telegram';
    const TYPE_WHATSAPP     = 'whatsapp';
    const TYPE_VIBER        = 'viber';
}