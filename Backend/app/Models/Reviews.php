<?php

namespace Backend\Models;

use Backend\Scopes\ReviewsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Reviews extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'reviews';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'excerpt',
        'description',
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
        'seo_id',
        'name',
        'description',
        'image',
        'email',
        'source',
        'slug',
        'is_active',
        'published_at',
    ];

    /**
     * @return BelongsTo
     */
    public function seo(): BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new ReviewsScope());

    }

}
