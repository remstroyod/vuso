<?php

namespace Backend\Models\Profile;

use Backend\Scopes\Profile\UsersScope;
use Backend\Traits\HasRolesAndPermissions;
use Egorovwebservices\Payhub\Interfaces\CardData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use \Egorovwebservices\Payhub\Interfaces\User as PayhubUser;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property string $email
 * @property string $name
 *
 * @property UserDetail $detail
 */
class User extends Authenticatable implements PayhubUser
{
    use HasFactory,
        Notifiable,
        HasRolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'otp',
        'password',
        'is_active'
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
     * @param $password
     * @return void
     */
    public function setPasswordAttribute($password)
    {

        if( ! empty( $password ) )
            $this->attributes['password'] = bcrypt($password);

    }

    /**
     * @return HasOne
     */
    public function detail(): HasOne
    {
        return $this->hasOne(UserDetail::class);
    }

    /**
     * @return HasMany
     */
    public function socials(): HasMany
    {
        return $this->hasMany(UserSocials::class);
    }

    /**
     * @return bool
     */
    public function isOnline(): bool
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new UsersScope());

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getPhone(): string|null
    {
        return $this->detail->phone;
    }

    public function getEmail(): string|null
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCardData(): CardData
    {
        return new \Backend\Modules\PayHub\Models\BaseModels\CardData();
    }
}
