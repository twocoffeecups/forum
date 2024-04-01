<?php

namespace App\Http\Resources\Dashboard\Forum;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'parentId' => $this->parentId,
            'name' => $this->name,
            'description' => $this->description,
            'parent' => $this->parent,
            'children' => $this->children,
        ];
    }
}
