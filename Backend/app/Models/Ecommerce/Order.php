<?php

namespace Backend\Models\Ecommerce;

use Backend\Models\Profile\User;
use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Presenters\Ecommerce\OrderPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use McCool\LaravelAutoPresenter\HasPresenter;

class Order extends Model implements HasPresenter
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
        'doc_blank_1c',
        'user_id',
        'guid',
        'status',
        'total',
        'subtotal',
        'is_payment'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history()
    {
        return $this->hasMany(OrderHistory::class);
    }

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return OrderPresenter::class;
    }

    /**
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::created(function($model)
        {
            $model->order_id = $model->order_id . '-' . $model->id;
            $model->save();
        });
    }

}
