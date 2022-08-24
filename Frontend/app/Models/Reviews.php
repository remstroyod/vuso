<?php
namespace Frontend\Models;

use Frontend\Scopes\IsActiveScope;
use Frontend\Scopes\ReviewsScope;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Reviews extends Model
{
    use HasTranslations;

    /**
     * @var string
     */
    protected $table = 'reviews';

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    public $translatable = ['name', 'excerpt', 'description'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeLast($query)
    {
        return $query->take(15);
    }

    /**
     * @return void
     */
    protected static function boot()
    {

        parent::boot();

        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new ReviewsScope());

    }

}
