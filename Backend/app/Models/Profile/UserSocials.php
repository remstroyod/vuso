<?php

namespace Backend\Models\Profile;

use Backend\Enums\SocialsIconsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSocials extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'users_socials';

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
        'user_id',
        'name',
        'image',
        'url',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'icons' => SocialsIconsEnum::class,
    ];

}
