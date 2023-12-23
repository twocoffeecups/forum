<?php

namespace App\Http\Resources\Client\Post;

use App\Http\Resources\Client\Forum\TopicTagResource;
use App\Http\Resources\Client\Topic\TopicAuthorResource;
use App\Http\Resources\Client\Topic\TopicForumResource;
use App\Http\Resources\Client\Topic\TopicLikeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'message' => $this->message,
            'rating' => $this->likes->count(),
            'likes' => TopicLikeResource::collection($this->likes),
            'views' => 1,
            'author' => new TopicAuthorResource($this->author),
            'replyPost' => new ReplyPostResource($this->replyPost()),
            'images' => $this->images,
            'files' => $this->files,
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
            'updated_at' => date('d.m.Y H:i', strtotime($this->updated_at)),
        ];
    }
}
