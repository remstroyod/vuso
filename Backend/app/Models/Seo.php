<?php

namespace Backend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Seo extends Model
{
    use HasFactory,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'seo';

    /**
     * @var string[]
     */
    public $translatable = [
        'h1',
        'title',
        'description',
        'keyword',
        'text',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'h1',
        'title',
        'description',
        'keyword',
        'robots',
        'canonical',
        'text',
        'text_active',
        'image',
        'slug'
    ];

}
