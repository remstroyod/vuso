<?php

namespace Backend\Modules\EDocuments\Models;

use Backend\Modules\EDocuments\Scopes\EDocumentsScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class EDocuments extends Model
{

    protected $table = 'edocuments';

    use HasFactory,
        SoftDeletes;

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
        'template_id',
        'name',
        'description',
        'is_active',
        'endpoint',
        'use',
        'folder',
        'filename',
    ];

    /**
     * @return HasMany
     */
    public function documents(): HasMany
    {
        return $this->hasMany(EDocumentsDocs::class, 'documents_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function template(): HasOne
    {
        return $this->hasOne(EDocumentsDocs::class, 'id', 'template_id')->select(['id', 'name', 'description']);
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new EDocumentsScope());

    }

}
