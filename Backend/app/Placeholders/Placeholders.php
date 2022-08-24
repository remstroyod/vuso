<?php

namespace Backend\Placeholders;

use Exception;

class Placeholders
{
    protected static $replacements = [];
    protected static $config = [
        'start' => '{{',
        'end' => '}}',
        'thorough' => true,
    ];
    protected static $start;
    protected static $end;
    protected static $thorough;


    /**
     * Sets a global replacement for a placeholder
     * @param string $string The placeholder to set a value for
     * @param mixed  $value  The value to replace it with
     */
    public static function set($string, $value)
    {
        self::$replacements[$string] = (string) $value;
    }

    /**
     * Checks a string for placeholders and then replaces them with the appropriate values
     * @param  string $string       A string containing placeholders
     * @param  array  $replacements An array of key/value replacements
     * @return string               The new string
     */
    public function parse($string, $replacements = [])
    {

        $replacements = array_merge(self::$replacements, $replacements);
        foreach ($replacements as $key => $val) {
            $string = str_ireplace(self::getStart().$key.self::getEnd(), $val, $string);
        }

        self::catchSkippedPlaceholders($string);

        return $string;
    }

    /**
     * Checks for any placeholders that are in the
     * string and then throws an Exception if one exists
     * @param  string $string The string to check
     */
    protected function catchSkippedPlaceholders($string)
    {
        if (self::getThorough() === true) {
            $matches = [];
            $pattern = "/".self::getStart(true).".*?".self::getEnd(true)."/";
            preg_match($pattern, $string, $matches);

            if (count($matches) > 0) {
                throw new Exception("Could not find a replacement for ".$matches[0], 1);
            }
        }
    }

    public function setStyle($start, $end)
    {
        self::setStart($start);
        self::setEnd($end);
    }

    public function setThorough($x)
    {
        self::$thorough = $x;
    }

    public function setStart($x)
    {
        self::$start = $x;
    }

    public function setEnd($x)
    {
        self::$end = $x;
    }

    public function getThorough()
    {
        return isset(self::$thorough) ? self::$thorough : self::$config['thorough'];
    }

    public function getStart($escaped = false)
    {

        $x = self::$start ? self::$start : self::$config['start'];
        return $escaped ? preg_quote($x) : $x;
    }

    public function getEnd($escaped = false)
    {
        $x = self::$end ? self::$end : self::$config['end'];
        return $escaped ? preg_quote($x) : $x;
    }
}
