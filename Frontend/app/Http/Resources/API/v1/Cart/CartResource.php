<?php

namespace Frontend\Http\Resources\API\v1\Cart;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class CartResource extends JsonResource
{

    /**
     * @var bool
     */
    public $preserveKeys = true;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $promocode = new Collection();

        if( $this->conditions )
        {

            if( is_array($this->conditions) )
            {
                foreach ( $this->conditions as $item )
                {
                    $promocode->put('name', $item->getName());
                    $promocode->put('type', $item->getType());
                    $promocode->put('value', $item->getValue());
                }
            }else{
                $promocode->put('name', $this->conditions->getName());
                $promocode->put('type', $this->conditions->getType());
                $promocode->put('value', $this->conditions->getValue());
            }

        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'attributes' => $this->attributes,
            'subtotal' => $this->price,
            'total' => $this->getPriceSumWithConditions(),
            'discount' => $this->conditions,
            'quantity' => $this->quantity,
            'promocode' => $promocode
        ];
    }

}
