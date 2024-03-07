<?php

namespace App\Http\Resources\Forum\Forum;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class AdministrationTopicResource extends JsonResource
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
            'postsCount' => $this->posts->count(),
            'views' => $this->views()->count(),
            'tags' => TopicTagResource::collection($this->tags),
            'author' => new PostAuthorResource($this->author),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
