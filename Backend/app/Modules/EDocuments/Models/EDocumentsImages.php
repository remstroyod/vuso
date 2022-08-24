<?php

namespace Backend\Modules\EDocuments\Models;

use Backend\Modules\EDocuments\Presenters\ImagesPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use McCool\LaravelAutoPresenter\HasPresenter;

class EDocumentsImages extends Model implements hasPresenter
{

    protected $table = 'edocuments_images_documents';

    use HasFactory;

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
        'document_id',
        'name',
        'image',
    ];

    /**
     * @return string
     */
    public function getPresenterClass(): string
    {
        return ImagesPresenter::class;
    }

    /**
     * @return BelongsTo
     */
    public function document(): BelongsTo
    {
        return $this->belongsTo(EDocumentsDocs::class, 'document_id', 'id');
    }

}
