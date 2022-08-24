<?php

namespace Backend\Modules\Bots\Models;

use Backend\Enums\LogTypesEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property int $id
 * @property string $type
 * @property string $bot_type
 * @property string $message
 * @property int $line
 * @property string $file
 */
class Log extends Model
{
    use HasFactory;

    protected $table = 'bots_logs';

    private static function createLog($message, string $type, string $bot_type, int $line, string $file = null)
    {
        $Log = new self();

        $Log->type = $type;
        $Log->bot_type = $bot_type;
        $Log->message = is_string($message) ? $message : json_encode($message);

        if($line) $Log->line = $line;
        if($file) $Log->file = $file;

        $Log->save();
    }

    public static function info($message, string $bot_type, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_INFO, $bot_type, $line, $file);
    }

    public static function log($message, string $bot_type, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_LOG, $bot_type, $line, $file);
    }

    public static function debug($message, string $bot_type, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_DEBUG, $bot_type, $line, $file);
    }

    public static function warning($message, string $bot_type, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_WARNING, $bot_type, $line, $file);
    }

    public static function error($message, string $bot_type, int $line = 0, string $file = null)
    {
        self::createLog($message, LogTypesEnum::TYPE_ERROR, $bot_type, $line, $file);
    }

    public static function exception(\Throwable $exception, string $bot_type, int $line = 0, string $file = null)
    {
        $message = [
            'message'   => $exception->getMessage(),
            'line'      => $exception->getLine(),
            'file'      => $exception->getFile()
        ];

        self::createLog($message, LogTypesEnum::TYPE_ERROR, $bot_type, $line, $file);
    }
}
