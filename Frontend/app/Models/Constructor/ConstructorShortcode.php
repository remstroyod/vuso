<?php

namespace Frontend\Models\Constructor;

use Frontend\Queries\Constructor\ConstructorShortcodeQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class ConstructorShortcode extends Model
{
    use HasFactory,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'constructor_shortcodes';

    /**
     * @var string[]
     */
    public $translatable = [
        'title',
        'subtitle',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param $query
     * @return ConstructorShortcodeQuery
     */
    public function newEloquentBuilder($query): ConstructorShortcodeQuery
    {

        return new ConstructorShortcodeQuery($query);

    }

}
