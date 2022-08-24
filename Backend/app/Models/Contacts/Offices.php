<?php

namespace Backend\Models\Contacts;

use Backend\Scopes\Contacts\OfficesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Offices extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'contacts_offices';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'address', 'time'];

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
    protected $fillable = ['name', 'country_id', 'address', 'time', 'email', 'phone', 'lat', 'lng', 'is_active'];

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new OfficesScope());

    }

}
