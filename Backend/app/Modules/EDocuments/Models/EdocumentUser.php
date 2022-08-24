<?php

namespace Backend\Modules\EDocuments\Models;

use Backend\Models\Log;
use Egorovwebservices\Payhub\Payhub;
use Frontend\Models\InsuranceStatusList;
use Frontend\Models\ObjInsuranceBuildings;
use Frontend\Models\ObjInsuranceCars;
use Frontend\Models\ObjInsurancePerson;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Str;
use Backend\Models\Profile\User;
use Backend\Models\Catalog\Product;
use Backend\Models\Ecommerce\Order;
use Illuminate\Database\Eloquent\Model;
use Backend\Modules\PayHub\Models\PayHubSystem;
use Egorovwebservices\Payhub\Interfaces\System;
use Egorovwebservices\Payhub\Interfaces\Contract;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Backend\Modules\PayHub\Models\BaseModels\PaymentData;
use Egorovwebservices\Payhub\Interfaces\User as PayhubUser;
use Egorovwebservices\Payhub\Interfaces\PaymentData as PaymentDataInterface;

/**
 * @property float $total
 * @property string $transaction_id
 *
 * @property Product $product
 * @property User $user
 */
class EdocumentUser extends Model implements Contract
{
    //private string $transaction_hash = '';

    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string
     */
    protected $table = 'edocument_users';

    /**
     * @var PaymentData|null
     */
    public PaymentDataInterface|null $paymentData = null;


    protected $casts = [
        'data' => 'array',
    ];

    protected $fillable = [
        'documents_id',
        'user_id',
        'product_id',
        'dogovor_id',
        'subtotal',
        'total',
        'storage',
        'folder',
        'filename',
        'path',
        'mimetype',
        'url',
        'extension',
        'source',
        'data',
        'payment_status',
        'transaction_id',
        'transaction_hash',
        'doc_blank_1c',
        'obj_model',
        'status_id',
        'obj_type',
        'doc_end_date',
        'is_pp',
    ];



    protected $appends = ['insurance_object'];

    public function getInsuranceObjectAttribute()
    {
        if ($this->obj_type === 'car') {
            return $this->obj_insurance_autos()->get();
        } else if ($this->obj_type === 'person') {
            return $this->obj_insurance_person()->get();
        } else if ($this->obj_type === 'building') {
            return $this->obj_insurance_homes()->get();
        }
        return [];
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(InsuranceStatusList::class, 'status_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function obj_insurance_homes()
    {
        return $this->belongsToMany(ObjInsuranceBuildings::class, 'edocuments_user_obj_insurance', 'document_id', 'obj_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function obj_insurance_autos()
    {
        return $this->belongsToMany(ObjInsuranceCars::class, 'edocuments_user_obj_insurance', 'document_id', 'obj_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function obj_insurance_person()
    {
        return $this->belongsToMany(ObjInsurancePerson::class, 'edocuments_user_obj_insurance', 'document_id', 'obj_id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->transaction_hash = md5( $model->id . env('APP_NAME') . time() . uniqid());
        });
    }

    /**
     * @return HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(EDocuments::class, 'id', 'documents_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function product(): HasOne
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function getPaySystemData(bool $is_recurrent = false, bool $has_3ds = true): System
    {
        $System = new PayHubSystem();
        $builder = $this->product->payhub()
            ->where($System->getIsDefaultColumn(), 1);

        return $builder->where($System->getIsRecurrentColumn(), intval($is_recurrent))->first();
    }

    public function getUser(): PayhubUser
    {
        return $this->user;
    }

    public function setTransactionId(mixed $transaction_id)
    {
        if($transaction_id !== null) {
            $transaction_id = strval($transaction_id);
        }

        $this->transaction_id = $transaction_id;
    }

    public function getTransactionId(): string|null
    {
        return $this->transaction_id;
    }

    public function setTransactionHash(string $hash)
    {
        $this->transaction_hash = $hash;
    }

    public function getTransactionHash(): string
    {

        return $this->transaction_hash;
    }

    public function getPaymentData(): PaymentDataInterface
    {
        if(! $this->paymentData) $this->paymentData = new PaymentData();

        $this->paymentData->setTransactionHash($this->getTransactionHash());
        $this->paymentData->setLocale(app()->getLocale());
        $this->paymentData->setDescription($this->product->name);
        $this->paymentData->setAmount($this->total);

        if(env('IS_TEST_SERVER', false)) {
            $this->paymentData->setAmount(0.5);
        }

        $this->paymentData->setOrderId(Str::random(10));
        return $this->paymentData;
    }

    public function setPaymentData(PaymentDataInterface $paymentData):void
    {
        $this->paymentData = $paymentData;
    }

    public function getPayHubService(): Payhub
    {
        return new Payhub();
    }
}
