<?php

namespace Backend\Modules\PayHub\Models;

use Backend\Modules\EDocuments\Models\EdocumentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PayHubLog extends Model
{
    use HasFactory;

    protected $table = 'payhub_logs';

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
        'system_id',
        'document_id',
        'status',
        'request',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'request' => 'array'
    ];

    /**
     * @return HasOne
     */
    public function document(): HasOne
    {
        return $this->hasOne(EdocumentUser::class, 'id', 'document_id');
    }

    /**
     * @return HasOne
     */
    public function system(): HasOne
    {
        return $this->hasOne(PayHubSystem::class, 'id', 'system_id');
    }
}
