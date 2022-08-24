<?php

namespace Backend\Modules\EDocuments\Models;

use Backend\Modules\EDocuments\Scopes\EDocumentsPlaceholdersScope;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EDocumentsPlaceholders extends Model
{
    protected $table = 'edocuments_placeholders';

    use HasFactory,
        SoftDeletes,
        Sluggable;

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
        'name',
        'slug',
        'render',
        'author_id',
    ];

    /**
     * @return \string[][]
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * @return void
     */
    protected static function boot(): void
    {

        parent::boot();
        static::addGlobalScope(new EDocumentsPlaceholdersScope());

    }
}
