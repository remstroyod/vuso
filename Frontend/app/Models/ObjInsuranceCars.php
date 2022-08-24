<?php

namespace Frontend\Models;

use Backend\Models\Dictionaries\Autoria\Mark;
use Backend\Models\Dictionaries\Autoria\Models;
use Backend\Models\Dictionaries\Autoria\Transmissions;
use Backend\Models\Dictionaries\Autoria\TsType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjInsuranceCars extends Model
{
    use HasFactory;

    protected $table = 'obj_insurance_cars';
    protected $fillable = [
        'reg_num',
        'engine_volume',
        'type',
        'number_passengers',
        'mark',
        'model',
        'cargo',
        'vin',
        'year',
        'run',
        'cost',
        'user_id',
    ];

    public function marks()
    {
        return $this->hasOne(Mark::class,'id','mark');
    }

    public function models()
    {
        return $this->hasOne(Models::class,'id','model');
    }

    public function transmission()
    {
        return $this->hasOne(Transmissions::class,'id','type');
    }

    public function tsType()
    {
        return $this->hasOne(TsType::class,'id','cargo');
    }

    public function carFullName () {
        $markName = $this->marks ? $this->marks->name : '';
        $modelName = $this->models ? $this->models->name : '';
        return $markName . ' ' .  $modelName;
    }

    public function transmissionName () {
        return $this->transmission ? $this->transmission->name : '';
    }

    public function tsTypeName () {
        return $this->tsType ? $this->tsType->ru_name : '';
    }

}

