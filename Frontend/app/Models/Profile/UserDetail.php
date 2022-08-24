<?php

namespace Frontend\Models\Profile;

use Carbon\Carbon;
use Frontend\Presenters\Profile\UserDetailPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Jenssegers\Date\Date;
use McCool\LaravelAutoPresenter\HasPresenter;

class UserDetail extends Model implements HasPresenter
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'users_detail';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $dates = [
        'published_at',
        'birthday',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'birthday'  => 'date:d.m.Y',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'birthday',
        'country',
        'city',
        'type_street',
        'street',
        'house_number',
        'apartment_number',
        'passport_id',
        'identification_number',
        'international_last_name',
        'international_first_name',
        'international_passport',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $value
     * @return void
     */
    public function setBirthdayAttribute($value)
    {
        $this->attributes['birthday'] = Date::parse($value)->format('Y-m-d');
    }

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return UserDetailPresenter::class;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * @param $phone
     * @return void
     */
    public function setPhoneAttribute($phone): void
    {
        $this->attributes['phone'] = preg_replace('/[^0-9]/', '', $phone);
    }



}
