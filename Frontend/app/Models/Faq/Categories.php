<?php
namespace Frontend\Models\Faq;

use Frontend\Scopes\Faq\CategoriesScope;
use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasTranslations, isActiveTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'faq_categories';

    /**
     * @var string[]
     */
    public $translatable = ['name'];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new CategoriesScope());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function faqs()
    {
        return $this->hasMany(Faq::class, 'category_id', 'id');

    }

}
