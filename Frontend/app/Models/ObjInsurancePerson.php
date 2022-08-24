<?php

namespace Frontend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjInsurancePerson extends Model
{
    use HasFactory;

    protected $table = 'obj_insurance_person';

    protected $fillable = [
        'middle_name',
        'lk_Id',
        'address_string',
        'INN',
        'date_begin',
        'first_name',
        'last_name',
        'birthday',
        'mail',
        'phone_number',
        'code',
        'ukr_passport',
        'international_passport',
        'user_id',
    ];

    /**
     * @return string
     */
    public function fullName(): string
    {

        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;

    }
}
