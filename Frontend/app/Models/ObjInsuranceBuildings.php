<?php

namespace Frontend\Models;

use Backend\Models\Dictionaries\Autoria\Mark;
use Backend\Models\Dictionaries\Country;
use Backend\Models\Dictionaries\Ewa\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class ObjInsuranceBuildings extends Model
{
    use HasFactory;

    protected $table = 'obj_insurance_buildings';

    protected $fillable = [
        'country_id',
        'city_id',
        'real_estate_form',
        'property_type',
        'address',
        'user_id'
    ];

    public function homeFullAddress ()
    {
        return $this->address;
    }

    public function realEstateForm ()
    {
        $realEstateForm = __( 'Собственное' );
        if ($this->real_estate_form === 'rented') {
            $realEstateForm = __( 'Арендованное' );
        }
        return $realEstateForm;
    }

    public function propertyType ()
    {
        $propertyType = __( 'Квартира' );
        if ($this->property_type === 'rented') {
            $propertyType = __( 'Жилой дом' );
        }
        return $propertyType;
    }

    public function countryBuilding()
    {
        return $this->hasOne(Country::class,'id','country_id');
    }

    public function city()
    {
        return $this->hasOne(City::class,'id','city_id');
    }

    public function countryCity ()
    {
       $locale = App::getLocale();
       $countryLocaleName = $locale === 'ua' ? 'country_name_uk' : 'name_full_rus';
       $cityLocaleName = $locale === 'ua' ? 'name' : 'name_rus';
       $city = $this->city ? $this->city[$cityLocaleName] : '';
       $country = $this->countryBuilding ? $this->countryBuilding[$countryLocaleName] : '';
       return $country . " " . $city;
    }

}
