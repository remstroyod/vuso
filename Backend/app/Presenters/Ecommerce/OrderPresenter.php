<?php

namespace Backend\Presenters\Ecommerce;

use Backend\Enums\OrderStatusEnum;
use McCool\LaravelAutoPresenter\BasePresenter;

class OrderPresenter extends BasePresenter
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

        $status = new OrderStatusEnum();

        return $status->name($this->status);

    }

    /**
     * @return string
     */
    public function getStatusClass(): string
    {

        $status = new OrderStatusEnum();

        return $status->class($this->status);

    }


}
