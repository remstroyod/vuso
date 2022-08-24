<?php

namespace Frontend\Models\Informations;

use Frontend\Queries\Informations\InformationsQuery;
use Frontend\Scopes\Informations\InformationsScope;
use Frontend\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Informations extends Model
{
    use HasTranslations, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'informations';

    /**
     * @var string[]
     */
    public $translatable = ['name'];

    /**
     * @param $query
     * @return InformationsQuery
     */
    public function newEloquentBuilder($query): InformationsQuery
    {

        return new InformationsQuery($query);

    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new InformationsScope());

    }

}
