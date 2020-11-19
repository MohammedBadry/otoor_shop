<?php

namespace App\Http\Resources\Countries;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'key' => $this->key,
            'is_default' => ! ! $this->is_default,
            'currency' => $this->currency,
            'flag' => url($this->getFirstMediaUrl('flags')),
            'cities' => CityResource::collection($this->whenLoaded('cities')),
        ];
    }
}
