<?php

namespace Backend\Models\Blocks;

use Backend\Presenters\Blocks\BlockPresenter;
use Backend\Presenters\Blocks\ElementsPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use McCool\LaravelAutoPresenter\HasPresenter;
use Spatie\Translatable\HasTranslations;

class BlockElement extends Model implements HasPresenter
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
        'link',
        'linktext',
        'image',
        'icon',
        'order',
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
     * @return HasOne
     */
    public function block(): HasOne
    {
        return $this->hasOne(Block::class, 'id', 'block_id');
    }
}
