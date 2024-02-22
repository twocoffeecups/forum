<?php

namespace App\Http\Resources\Forum\ForumCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class ForumCategoryResource extends JsonResource
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
            'name' => $this->name,
            //'posts' => $this->posts,
            'children' => ForumResource::collection($this->children),
        ];
    }
}
