<?php

namespace App\Http\Resources\Client\Topic;

use App\Http\Resources\Client\Forum\TopicTagResource;
use App\Http\Resources\Client\Post\PostResource;
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
            'content' => $this->content,
            'rating' => $this->likes->count(),
            'likes' => TopicLikeResource::collection($this->likes),
            'status' => $this->status,
            'views' => 1,
            'forum' => new TopicForumResource($this->forum),
            'tags' => TopicTagResource::collection($this->tags),
            'author' => new TopicAuthorResource($this->author),
            'images' => $this->images,
            'files' => $this->files,
            'posts' => PostResource::collection($this->posts),
            'isRejected' => new TopicRejectedReasonResource($this->isRejected),
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
            'updated_at' => date('d.m.Y H:i', strtotime($this->updated_at)),
        ];
    }
}
