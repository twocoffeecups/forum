<?php

namespace App\Http\Resources\Forum\Forum;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildrenForumResource extends JsonResource
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
            'rating' => 14,
            'posts' => 31,
            'views' => 3,
            'latestPost' => 'Post text...',
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
        ];
    }
}
