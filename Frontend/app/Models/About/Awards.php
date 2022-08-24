<?php
namespace Frontend\Models\About;

use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Awards extends Model
{
    use HasTranslations, isActiveTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'about_awards';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'nomination', 'from'];

}
