<?php

namespace App\Http\Resources\Client\Search;

use App\Http\Resources\Client\Forum\TopicTagResource;
use App\Http\Resources\Client\Post\PostResource;
use App\Http\Resources\Client\Topic\TopicAuthorResource;
use App\Http\Resources\Client\Topic\TopicForumResource;
use App\Http\Resources\Client\Topic\TopicLikeResource;
use App\Http\Resources\Client\Topic\TopicRejectedReasonResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicSearchResource extends JsonResource
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
            'type' => 'topic',
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
//            'posts' => PostResource::collection($this->posts),
            'isRejected' => new TopicRejectedReasonResource($this->isRejected),
            'created_at' => $this->created_at->format('Y.d.m'),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}
