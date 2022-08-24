<?php

namespace Backend\Models\Partners;

use Backend\Models\Tag;
use Backend\Scopes\Partners\PartnersScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\Translatable\HasTranslations;

class Partners extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'partners';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'excerpt'];

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
        'image',
        'excerpt',
        'slug',
        'is_active',
        'order',
    ];

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {

        return $this->belongsToMany(Tag::class, 'pages_tags', 'pages_id');

    }

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
        static::addGlobalScope(new PartnersScope());

    }

}
