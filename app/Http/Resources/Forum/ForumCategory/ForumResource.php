<?php

namespace App\Http\Resources\Forum\ForumCategory;

use App\Http\Resources\Forum\Forum\LatestPostResource;
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
            'name' => $this->name,
            'rating' => 14,
            'posts' => $this->totalPosts(),
            'views' => 3,
            'latestPost' => new LatestPostResource($this->latestPost()),
            'created_at' => $this->created_at->format('Y-d-m'),
        ];
    }
}
