<?php

namespace Backend\Models\Partners;

use Backend\Scopes\Partners\CategoriesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'partners_categories';

    /**
     * @var string[]
     */
    public $translatable = ['name'];

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
    protected $fillable = ['parent_id', 'seo_id', 'name', 'slug', 'is_active'];

    /**
     * @param $value
     */
    public function setNameAttribute($value)
    {
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
        $this->attributes['name'] = $value;
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new CategoriesScope());

    }

}
