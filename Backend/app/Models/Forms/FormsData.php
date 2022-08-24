<?php

namespace Backend\Models\Forms;

use Backend\Enums\FormsEnum;
use Backend\Queries\Forms\Data\FormsDataQuery;
use Backend\Scopes\Forms\FormsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormsData extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'formsdata';

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
        'type',
        'name',
        'email',
        'phone',
        'message',
        'ip',
        'url',
        'browser',
        'is_auth',
        'source'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'forms' => FormsEnum::class,
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new FormsScope());

    }

    /**
     * @param $query
     * @return FormsDataQuery
     */
    public function newEloquentBuilder($query): FormsDataQuery
    {

        return new FormsDataQuery($query);

    }

}
