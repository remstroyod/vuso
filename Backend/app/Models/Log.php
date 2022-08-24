<?php

namespace Backend\Models;

use Backend\Enums\LogTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string $message
 * @property int $line
 * @property string $file
 */
class Log extends Model
{
    use HasFactory;

    private static function createLog($message, string $type, int $line, string $file = null)
    {
        $Log = new self();

        $Log->type = $type;
        $Log->message = is_string($message) ? $message : json_encode($message);

        if($line) $Log->line = $line;
        if($file) $Log->file = $file;

        $Log->save();
    }

    public static function info($message, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_INFO, $line, $file);
    }

    public static function log($message, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_LOG, $line, $file);
    }

    public static function debug($message, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_DEBUG, $line, $file);
    }

    public static function warning($message, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_WARNING, $line, $file);
    }

    public static function error($message, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_ERROR, $line, $file);
    }

    public static function exception(\Throwable $exception, int $line = 0, string $file = null)
    {
        $message = [
            'message'   => $exception->getMessage(),
            'line'      => $exception->getLine(),
            'file'      => $exception->getFile()
        ];

        self::createLog($message, LogTypesEnum::TYPE_ERROR, $line, $file);
    }
}
