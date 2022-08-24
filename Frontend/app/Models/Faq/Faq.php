<?php

namespace Frontend\Models\Faq;

use Frontend\Models\Seo;
use Frontend\Scopes\Faq\FaqScope;
use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasTranslations, isActiveTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'faqs';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'description'];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new FaqScope());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {

        return $this->belongsTo(Seo::class, 'category_id', 'id');

    }

}
