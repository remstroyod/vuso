<?php

namespace Backend\Models\Faq;

use Backend\Models\Pages;
use Backend\Models\Seo;
use Backend\Scopes\Faq\FaqScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Faq extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'faqs';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'description'];

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
        'category_id',
        'seo_id',
        'name',
        'description',
        'is_active',
        'author_id',
        'order',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Categories::class, 'category_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {

        return $this->belongsTo(Seo::class, 'seo_id', 'id');

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pages(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Pages::class, 'pages_faq', 'pages_id', 'faqs_id');
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new FaqScope());

    }

}
