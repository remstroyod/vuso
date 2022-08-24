<?php

namespace Backend\Models\Menu;

use Backend\Queries\Menu\MenuElementsQuery;
use Backend\Scopes\Menu\MenuElementsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class MenuItem extends Model
{
    use HasFactory,
        HasTranslations;

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
     * @var string[]
     */
    protected $fillable = [
        'parent_id',
        'menu_id',
        'title',
        'url',
        'attrclass',
        'attrid',
        'attrtitle',
        'attrtarget',
        'attrrel',
        'icon',
        'iconsvg',
        'iconposition',
        'order',
        'is_active',
        'author_id',
    ];

    /**
     * @param $query
     * @return MenuElementsQuery
     */
    public function newEloquentBuilder($query): MenuElementsQuery
    {

        return new MenuElementsQuery($query);

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new MenuElementsScope());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parents(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function childrenMenu(): HasMany
    {
        return$this->hasMany(MenuItem::class, 'parent_id', 'id')->with('parents');
    }
}
