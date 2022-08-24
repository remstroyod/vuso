<?php

namespace Frontend\Models\Articles;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{

    use HasTranslations, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'articles_categories';

    /**
     * @var string[]
     */
    public $translatable = ['name'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

}
