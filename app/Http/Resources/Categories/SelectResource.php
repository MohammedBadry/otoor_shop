<?php

namespace App\Http\Resources\Categories;

use Illuminate\Http\Resources\Json\JsonResource;

class SelectResource extends JsonResource
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
            'text' => $this->getFullName(),
            'image' => $this->getFirstMediaUrl(),
        ];
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        $names = [];

        $category = $this;
        do {
            $names[] = $category->name;
            $category = $category->parent;
        } while ($category);

        return implode(' - ', array_reverse($names));
    }
}
