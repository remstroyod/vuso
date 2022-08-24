<?php

namespace Backend\Models;

use Backend\Models\Partners\Partners;
use Backend\Queries\Tags\TagQuery;
use Backend\Scopes\Tag\TagScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Tag extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
    ];

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'type',
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new TagScope());

    }

    /**
     * @param $query
     * @return TagQuery
     */
    public function newEloquentBuilder($query): TagQuery
    {

        return new TagQuery($query);

    }

    /**
     * @return BelongsToMany
     */
    public function partners(): BelongsToMany
    {

        return $this->belongsToMany(Partners::class);

    }

}
