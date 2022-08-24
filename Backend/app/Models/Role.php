<?php

namespace Backend\Models;

use Backend\Scopes\Security\RolesScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    /**
     * @param $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        if (empty($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value, '_');
        }
        $this->attributes['name'] = $value;
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new RolesScope());
    }
}
