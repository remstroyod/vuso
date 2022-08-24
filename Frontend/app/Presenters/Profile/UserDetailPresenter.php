<?php

namespace Frontend\Presenters\Profile;

use Backend\Enums\StreetTypeEnum;
use Illuminate\Support\Str;
use McCool\LaravelAutoPresenter\BasePresenter;

class UserDetailPresenter extends BasePresenter
{

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function fullName(): string
    {

        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;

    }

    /**
     * @return string
     */
    public function fullAddress(): string
    {

        $type_street = StreetTypeEnum::$name;
        $arr = [];

        if( $this->city )
            array_push($arr, $this->city);

        if( $this->street )
            array_push($arr, Str::lower($type_street[$this->type_street]) . ' ' . $this->street);

        if( $this->house_number )
            array_push($arr, Str::lower($this->house_number));

        if( $this->apartment_number )
            array_push($arr, Str::lower($this->apartment_number));

        return implode(', ', $arr);

    }

    /**
     * @return string
     */
    public function internationalFullName(): string
    {

        return $this->international_first_name . ' ' . $this->international_last_name;

    }

}
