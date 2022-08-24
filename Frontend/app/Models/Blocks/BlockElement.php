<?php

namespace Frontend\Models\Blocks;

use Frontend\Scopes\BlocksElementsScope;
use Frontend\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\Translatable\HasTranslations;

class BlockElement extends Model
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
        'subtitle',
        'title',
        'excerpt',
        'description',
        'link',
        'linktext',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'block_id',
        'subtitle',
        'title',
        'excerpt',
        'description',
        'image',
        'order',
        'is_active',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new BlocksElementsScope());
    }

    /**
     * @return HasOne
     */
    public function block(): HasOne
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
