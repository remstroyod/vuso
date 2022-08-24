<?php
namespace Frontend\Models\About;

use Frontend\Scopes\About\TeamScope;
use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Team extends Model
{
    use HasTranslations, isActiveTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'about_team';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'position',
        'description',
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new TeamScope());

    }

}
