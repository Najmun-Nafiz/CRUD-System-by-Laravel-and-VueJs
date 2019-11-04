<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VueResource extends JsonResource
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

            'Id' => $this->id,
            'Name' => $this->name,
            'Email' => $this->email,
            'Mobile' => $this->phone,
            'Address' => $this->address,
            'Total' => $this->total
        ];
    }
}
