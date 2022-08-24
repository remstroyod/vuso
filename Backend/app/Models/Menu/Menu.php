<?php

namespace Backend\Models\Menu;

use Backend\Scopes\Menu\MenuScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Menu extends Model
{
    use HasFactory,
        HasTranslations;

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
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
     * @var string[]
     */
    protected $fillable = [
        'name',
        'title',
        'attrclass',
        'attrid',
        'wrapper',
        'order',
        'is_active',
        'author_id',
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
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
