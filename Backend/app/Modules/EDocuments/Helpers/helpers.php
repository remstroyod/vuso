<?php

/**
 *	EDocuments Helpers
 */

use Illuminate\Support\Facades\Cache;

/**
 * Settings
 * @param $value
 * @return mixed
 */
function edocuments_settings($value)
{
    return Cache::get('edocuments_settings')->where('name', $value)->first()->value;
}
