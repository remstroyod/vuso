<?php

namespace Backend\Models\Informations;

use Backend\Models\Seo;
use Backend\Scopes\Informations\InformationsScope;
use Frontend\Scopes\IsActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Informations extends Model
{
    use HasFactory,
        SoftDeletes,
        HasTranslations;

    /**
     * @var string
     */
    protected $table = 'informations';

    /**
     * @var string[]
     */
    public $translatable = ['name'];

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
        'category_id',
        'seo_id',
        'name',
        'file',
        'is_active',
        'order',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function seo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Seo::class, 'seo_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new IsActiveScope());
        static::addGlobalScope(new InformationsScope());

    }

}
