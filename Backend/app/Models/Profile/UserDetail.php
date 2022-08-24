<?php

namespace Backend\Models\Profile;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $phone
 */
class UserDetail extends Model
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
    protected $dates = ['published_at'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'view_name',
        'phone',
        'birthday',
        'image',
        'avatar',
        'website',
        'country',
        'city',
        'address',
        'about',
    ];

    /**
     * Get Full Name User
     * @return string
     */
    public function getFullNameAttribute(): string
    {

        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);

    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
