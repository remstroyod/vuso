<?php

namespace Backend\Models\Blocks;

use Backend\Presenters\Blocks\BlockPresenter;
use Backend\Scopes\Blocks\BlockScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class Block extends Model implements HasPresenter
{

    use HasFactory,
        HasTranslations;

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
        'model',
        'content',
        'subtitle',
        'title',
        'excerpt',
        'description',
        'link',
        'linktext',
        'image',
        'video',
        'videotitle',
        'videoposter',
        'order',
        'component',
        'position',
        'is_active',
        'published_at',
    ];

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return BlockPresenter::class;
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new BlockScope());

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function elements()
    {
        return $this->hasMany(BlockElement::class);
    }

}
