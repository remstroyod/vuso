<?php

namespace Backend\Models\Constructor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ConstructorShortcode extends Model
{
    use HasFactory,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'constructor_shortcodes';

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
        'subtitle',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'title',
        'subtitle',
        'limit',
    ];

}
