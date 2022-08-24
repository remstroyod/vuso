<?php

namespace Frontend\Models;

use Frontend\Models\Profile\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InsuranceDocs extends Model
{
    use HasFactory;

    protected $fillable = [
           'auto_reg_num',
           'doc_insurance_tariff_id',
           'status_id',
           'doc_blank',
           'auto_engine_volume',
           'doc_insurance_tariff_name',
           'auto_type',
           'doc_end_date',
           'doc_product',
           'doc_action_name',
           'auto_tumber_passengers',
           'doc_action_id',
           'doc_amount',
           'doc_payment',
           'doc_on_date',
           'doc_inure_date',
           'adress',
           'auto_mark',
           'insured',
           'auto_model',
           'auto_cargo',
           'auto_vin',
           'auto_year',
           'auto_run',
           'autocost',
           'user_id',
    ];

    protected $with = ['status'];

    /**
     * @return BelongsTo
     */
    public function status()
    {
        return $this->belongsTo(InsuranceStatusList::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
