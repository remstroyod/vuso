<?php

namespace Frontend\Models\Menu;

use Backend\Enums\MenuEnum;
use Frontend\Presenters\MenuPresenter;
use Frontend\Scopes\IsActiveScope;
use Frontend\Scopes\Menu\MenuScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Menu extends Model implements HasPresenter
{
    use HasFactory,
        HasTranslations;

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
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
    public function getPresenterClass()
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
        static::addGlobalScope(new MenuScope());
    }

    /**
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
