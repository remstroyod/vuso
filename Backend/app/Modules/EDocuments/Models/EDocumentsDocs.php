<?php

namespace Backend\Modules\EDocuments\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class EDocumentsDocs extends Model
{
    protected $table = 'edocuments_documents';

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
        'documents_id',
        'name',
        'description',
        'template',
        'file',
        'filename',
        'extension',
        'is_active',
        'author_id',
    ];

    /**
     * @return HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(EDocuments::class, 'id', 'documents_id');
    }

    /**
     * @return hasMany
     */
    public function images(): hasMany
    {
        return $this->hasMany(EDocumentsImages::class, 'document_id', 'id');
    }

}
