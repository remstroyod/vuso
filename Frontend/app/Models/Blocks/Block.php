<?php

namespace Frontend\Models\Blocks;

use Frontend\Scopes\BlocksScope;
use Frontend\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Block extends Model
{

    use HasFactory, HasTranslations;

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
    public $translatable = [
        'content',
        'subtitle',
        'title',
        'excerpt',
        'description',
        'linktext',
        'videotitle',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'page_id',
        'content',
        'subtitle',
        'title',
        'excerpt',
        'description',
        'image',
        'order',
        'component',
        'is_active',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new BlocksScope());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elements()
    {
        return $this->hasMany(BlockElement::class);
    }

}
