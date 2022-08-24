<?php

namespace Frontend\Models\Partners;

use Frontend\Models\Tag;
use Frontend\Scopes\IsActiveScope;
use Frontend\Scopes\Partners\PartnersScope;
use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Translatable\HasTranslations;

class Partners extends Model
{
    use HasTranslations, isActiveTrait;

    /**
     * @var string
     */
    protected $table = 'partners';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'excerpt'];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new PartnersScope());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {

        return $this->belongsTo(Categories::class, 'category_id', 'id');

    }

    /**
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {

        return $this->belongsToMany(Tag::class, 'pages_tags', 'pages_id');

    }

}
