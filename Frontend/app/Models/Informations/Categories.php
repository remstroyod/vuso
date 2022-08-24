<?php
namespace Frontend\Models\Informations;

use Frontend\Scopes\Catalog\CategoriesScope;
use Frontend\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasTranslations, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'informations_categories';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'description'];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new CategoriesScope());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parents()
    {

        return $this->hasMany(self::class, 'parent_id', 'id');

    }

    /**
     * @return bool
     */
    public function isParent()
    {

        return !$this->parent_id ? true : false;

    }

    /**
     * @return bool
     */
    public function isChildren()
    {

        return $this->parents()->exists() ? true : false;

    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeParent($query)
    {

        return $query->whereNull('parent_id');

    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeChildrens($query)
    {

        return $query->whereNotNull('parent_id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function informations()
    {

        return $this->hasMany(Informations::class, 'category_id', 'id');

    }

}
