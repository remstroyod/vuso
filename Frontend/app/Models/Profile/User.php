<?php

namespace Frontend\Models\Profile;

use Backend\Modules\EDocuments\Models\EdocumentUser;
use Backend\Traits\HasRolesAndPermissions;
use Frontend\Models\InsuranceDocs;
use Frontend\Models\ObjInsuranceCars;
use Frontend\Models\ObjInsuranceBuildings;
use Frontend\Models\ObjInsurancePerson;
use Frontend\Presenters\Profile\UserPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property string|null $sms_code
 *
 * @property UserDetail $detail
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndPermissions;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'provider',
        'provider_id',
        'sms_code',
        'otp',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = ['created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function detail(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * @return HasMany
     */
    public function objInsurancePersons()
    {
        return $this->hasMany(ObjInsurancePerson::class);
    }
    /**
     * @return HasMany
     */
    public function objInsuranceCars()
    {
        return $this->hasMany(ObjInsuranceCars::class);
    }

    /**
     * @return HasMany
     */
    public function objInsuranceBuildings()
    {
        return $this->hasMany(ObjInsuranceBuildings::class);
    }

    /**
     * @return HasMany
     */
    public function eDocumentUser()
    {
        return $this->hasMany(EdocumentUser::class)->orderBy('id', 'desc');
    }

    /**
     * @return HasMany
     */
    public function insuranceDocs(): HasMany
    {
        return $this->hasMany(InsuranceDocs::class);
    }

    /**
     * @return HasMany
     */
    public function providers(): HasMany
    {
        return $this->hasMany(UserProvider::class);
    }

    /**
     * @param $provider
     * @return HasOne
     */
    public function provider($provider)
    {
        return $this->hasOne(UserProvider::class)->where('provider', '=', $provider);
    }

    /**
     * @return HasMany
     */
    public function cars(): HasMany
    {
        return $this->hasMany(UserCar::class);
    }

        /**
     * @return HasMany
     */
    public function insuranceAuto(): HasMany
    {
        return $this->hasMany(ObjInsuranceCars::class);
    }
}
