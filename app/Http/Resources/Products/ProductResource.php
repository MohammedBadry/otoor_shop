<?php

namespace App\Http\Resources\Products;

use App\Support\Money;
use Illuminate\Http\Resources\Json\JsonResource;
use AhmedAliraqi\LaravelMediaUploader\Transformers\MediaResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'old_price' => Money::make($this->price),
            'new_price' => Money::make($this->price),
            'images' => MediaResource::collection($this->getMedia()),
        ];
    }
}
