<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'total' => $this->total,
            'order_number' => $this->order_number,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'customer_address' => $this->customer_address,
            'customer_phone' => $this->customer_phone
        ];
        // return parent::toArray($request);
    }
}
