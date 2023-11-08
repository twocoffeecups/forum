<?php

namespace App\Http\Resources\Client\ForumCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class ForumResource extends JsonResource
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
            'title' => $this->title,
            'rating' => 14,
            'posts' => 31,
            'views' => 3,
            'latestPost' => 'Post text...',
            'created_at' => $this->created_at,
        ];
    }
}
