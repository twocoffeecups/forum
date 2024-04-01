<?php

namespace App\Http\Resources\Dashboard\User;

use App\Http\Resources\Forum\Forum\LatestPostResource;
use App\Http\Resources\Forum\Forum\PostAuthorResource;
use App\Http\Resources\Forum\Forum\TopicTagResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserTopicResource extends JsonResource
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
            'status' => $this->status,
            'rating' => $this->likes->count(),
            'postsCount' => $this->posts->count(),
            'views' => 1,
            'latestPost' => new LatestPostResource($this->latestPost()),
            'tags' => TopicTagResource::collection($this->tags),
            'author' => new PostAuthorResource($this->author),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
