<?php 

namespace Backend\DTO;


class CarSearchTransform implements \Serializable, \JsonSerializable
{
    protected  $car;

    public function __construct(array $data = [])
    {
        $this->car = $data;
    }

    public function getCarVin(){
        return $this->car['car']['vin'];
    }


    public function serialize(): string
    {
    }

    public function unserialize($data): CarSearchTransform
    {
    }

    public function jsonSerialize()
    {
    }

}