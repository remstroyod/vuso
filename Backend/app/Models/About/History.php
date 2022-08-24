<?php

namespace Backend\Models\About;

use Backend\Scopes\About\HistoryScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class History extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

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
        'year',
        'select',
        'hint',
        'is_active'
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new HistoryScope());

    }

}
