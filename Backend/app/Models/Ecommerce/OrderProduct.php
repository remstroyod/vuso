<?php

namespace Backend\Models\Ecommerce;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderProduct extends Model
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
        'order_id',
        'product_id',
        'product_id_hash',
        'document_id',
        'promocode_id',
        'name',
        'price',
        'quantity',
    ];

    /**
     * @return HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(EdocumentUser::class, 'id', 'document_id');
    }

    public function promocode(): HasOne
    {
        return $this->hasOne(Promocode::class, 'id', 'promocode_id');
    }

}
