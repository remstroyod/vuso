<?php

namespace Frontend\Models\Menu;

use Frontend\Presenters\MenuPresenter;
use Frontend\Scopes\IsActiveScope;
use Frontend\Scopes\Menu\MenuElementsScope;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model implements hasPresenter
{
    use HasTranslations;

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
        'attrtitle',
        'url',
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
     * @return string
     */
    public function getPresenterClass(): string
    {
        return MenuPresenter::class;
    }

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new MenuElementsScope());
    }

    /**
     * @param $position
     * @return string
     */
    public function getIcon($position): string
    {

        if( $this->iconsvg )
        {
            if( $this->iconposition === $position )
            {
                return $this->iconsvg;
            }
        }

       return '';

    }
}
