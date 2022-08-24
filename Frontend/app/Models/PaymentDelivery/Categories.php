<?php
namespace Frontend\Models\PaymentDelivery;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Categories extends Model
{
    use HasTranslations, SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'payment_delivery_categories';

    /**
     * @var string[]
     */
    public $translatable = ['name', 'description'];

    /**
     * @return BelongsTo
     */
    public function parents()
    {

        return $this->hasMany(self::class, 'parent_id', 'id');

    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeChildrens($query)
    {

        return $query->whereNotNull('parent_id');

    }

    /**
     * @return bool
     */
    public function isParent()
    {

        return !$this->parent_id ? true : false;

    }

    /**
     * @return bool
     */
    public function isChildren()
    {

        return $this->parents()->exists() ? true : false;

    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeParent($query)
    {

        return $query->whereNull('parent_id');

    }

}
