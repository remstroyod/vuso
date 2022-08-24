<?php
namespace Frontend\Models\About;

use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class History extends Model
{
    use HasTranslations, isActiveTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'about_history';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'hint',
    ];

}
