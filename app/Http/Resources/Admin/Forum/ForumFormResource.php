<?php

namespace App\Http\Resources\Admin\Forum;

use Illuminate\Http\Resources\Json\JsonResource;

class ForumFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'children' => ForumFormResource::collection($this->descendantsTree),
        ];
    }
}
