<?php

namespace Backend\Presenters\Ecommerce;

use Backend\Enums\PromocodeStatusEnum;
use Carbon\Carbon;
use McCool\LaravelAutoPresenter\BasePresenter;

class PromocodePresenter extends BasePresenter
{

    public function __construct()
    {

    }

    /**
     * @param $model
     * @return string
     */
    public function getStatus(): string
    {

        $status = new PromocodeStatusEnum();

        if ( empty( $this->expires_at ) || $this->endDate($this->expires_at->format('Y-m-d H:i:s')) )
        {
            return $status->name(1);
        }else{
            return $status->name(2);
        }

    }

    /**
     * @return string
     */
    public function getStatusClass(): string
    {

        $status = new PromocodeStatusEnum();

        if ( empty( $this->expires_at ) || $this->endDate($this->expires_at->format('Y-m-d H:i:s')) )
        {
            return $status->class(1);
        }else{
            return $status->class(2);
        }

    }

    /**
     * @param string $date
     * @return bool
     */
    private function endDate(string $date): bool
    {

        if (Carbon::parse($date)->getTimestamp() < Carbon::now()->getTimestamp()) {
            return false;
        }

        return true;

    }

}
