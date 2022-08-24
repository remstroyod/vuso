<?php

namespace Frontend\Models\Partners;

use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasTranslations, isActiveTrait;

    /**
     * @var string
     */
    protected $table = 'partners_categories';

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
