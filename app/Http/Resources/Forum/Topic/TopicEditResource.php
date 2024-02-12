<?php

namespace App\Http\Resources\Forum\Topic;

use App\Http\Resources\Forum\Post\PostResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicEditResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'rating' => $this->likes->count(),
            'likes' => TopicLikeResource::collection($this->likes),
            'views' => 1,
            'forum' => new TopicForumResource($this->forum),
            'tags' => TopicTagFormResource::collection($this->tags),
            'author' => new TopicAuthorResource($this->author),
            'images' => $this->images,
            'files' => $this->files,
            'posts' => PostResource::collection($this->posts),
            'isRejected' => new TopicRejectedReasonResource($this->isRejected),
            'created_at' => $this->created_at->format('Y.d.m'),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}
