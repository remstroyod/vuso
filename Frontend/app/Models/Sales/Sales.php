<?php

namespace Frontend\Models\Sales;

use Backend\Models\Seo;
use Frontend\Queries\Sales\SalesQuery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Sales extends Model
{
    use SoftDeletes, HasTranslations;

    /**
     * @var string
     */
    protected $table = 'sales';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'excerpt',
        'description'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = ['published_at'];

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo()
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @param $query
     * @return SalesQuery
     */
    public function newEloquentBuilder($query): SalesQuery
    {

        return new SalesQuery($query);

    }

}
