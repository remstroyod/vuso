<?php
namespace Frontend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FormsData extends Model
{

    /**
     * @var string
     */
    protected $table = 'formsdata';

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'type',
        'name',
        'email',
        'phone',
        'message',
        'ip',
        'url',
        'browser',
        'is_auth',
        'source'
    ];

    /**
     * @param $phone
     * @return void
     */
    public function setPhoneAttribute($phone): void
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $phone);
    }

}
