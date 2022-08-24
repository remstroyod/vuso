<?php

namespace Backend\Models\About;

use Backend\Scopes\About\AwardsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\Translatable\HasTranslations;

class Awards extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'about_awards';

    /**
     * @var string[]
     */
    public $translatable = [
        'name',
        'nomination',
        'from'
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = [
        'published_at',
        'date',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'nomination',
        'from',
        'date',
        'file',
        'is_active',
        'author_id'
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new AwardsScope());

    }

    /**
     * @param $date
     * @return void
     */
    public function setDateAttribute($date): void
    {
        $this->attributes['date'] = Carbon::parse('01-01-' . $date)->format('Y-m-d');
    }

}
