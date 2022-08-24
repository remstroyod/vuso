<?php

namespace Frontend\Models;

use Frontend\Presenters\SeoPresenter;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Seo extends Model implements hasPresenter
{
    use HasTranslations;

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
        'text'
    ];

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return SeoPresenter::class;
    }
}
