<?php
namespace Frontend\Models\Contacts;

use Frontend\Traits\IsActiveTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Countries extends Model
{
    use HasTranslations, isActiveTrait, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'contacts_countries';

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

    /**
     * @return HasMany
     */
    public function offices(): HasMany
    {
        return $this->hasMany(Offices::class, 'country_id', 'id');
    }

}
