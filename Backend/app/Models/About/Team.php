<?php

namespace Backend\Models\About;

use Backend\Scopes\About\TeamScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Team extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

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
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'position',
        'description',
        'linkedin',
        'email',
        'image',
        'image_revert',
        'is_active',
        'author_id',
        'order',
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
