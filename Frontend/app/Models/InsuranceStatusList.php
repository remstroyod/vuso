<?php

namespace Frontend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class InsuranceStatusList extends Model
{
    use HasFactory, HasTranslations;


    public $translatable = ['name'];

    protected $fillable = [
        'color',
        'name',
        '1c_status',
        'parameter',
        ];

}
