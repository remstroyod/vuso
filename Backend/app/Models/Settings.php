<?php

namespace Backend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    /*
     * @var string
     */
    protected $table = 'settings';

    //protected $primaryKey = 'name';

    /**
     * @var string[]
     */
    public $translatable = [];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'value',
        'name'
    ];

    /**
     * @param $name
     * @return mixed
     */
    public static function get($name)
    {

        $value = self::where('name', $name)->first();

        if( $value )
            return $value->value;

    }

    /**
     * @return object
     */
    public function getAll(): object
    {

        return (object) $this->all()->pluck('value', 'name')->toArray();

    }

}
