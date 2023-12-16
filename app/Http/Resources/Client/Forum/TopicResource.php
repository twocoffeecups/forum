<?php

namespace App\Http\Resources\Client\Forum;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicResource extends JsonResource
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
            'rating' => $this->likes->count(),
            'postsCount' => $this->posts->count(),
            'views' => 1,
            'latestPost' => new LatestPostResource($this->latestPost()),
            'tags' => TopicTagResource::collection($this->tags),
            'author' => new PostAuthorResource($this->author),
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
        ];
    }
}