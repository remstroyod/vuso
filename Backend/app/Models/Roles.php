<?php
namespace Backend\Models;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{

    /**
     * @var string
     */
    protected $table = 'users_roles';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'role_id',
    ];
}
