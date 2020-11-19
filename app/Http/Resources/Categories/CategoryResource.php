<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\JsonResource;
use AhmedAliraqi\LaravelMediaUploader\Transformers\MediaResource;

class CategoryResource extends JsonResource
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
            'image' => $this->when(
                ! ! $this->getFirstMedia(),
                new MediaResource($this->getFirstMedia())
            ),
            'parent' => new static($this->whenLoaded('parent')),
            'subcategories' => static::collection($this->whenLoaded('subcategories')),
        ];
    }
}
