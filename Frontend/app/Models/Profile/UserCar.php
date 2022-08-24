<?php

namespace Frontend\Models\Profile;

use Frontend\Queries\Profile\CarsQuery;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserCar extends Model
{
    use HasFactory;

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
    protected $fillable = [
        'user_id',
        'model',
        'number',
        'engine',
        'price',
        'year',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $query
     * @return CarsQuery
     */
    public function newEloquentBuilder($query): CarsQuery
    {

        return new CarsQuery($query);

    }
}
