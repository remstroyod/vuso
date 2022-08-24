<?php

namespace Frontend\Models\Contacts;

use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Offices extends Model
{
    use HasTranslations, isActiveTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'contacts_offices';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'address', 'time'];

}
