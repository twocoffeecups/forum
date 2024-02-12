<?php

namespace App\Http\Resources\Forum\Search;

use App\Http\Resources\Forum\Post\ReplyPostResource;
use App\Http\Resources\Forum\Topic\TopicAuthorResource;
use App\Http\Resources\Forum\Topic\TopicLikeResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PostSearchResource extends JsonResource
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
            'type' => 'post',
            'id' => $this->id,
            'message' => $this->message,
            'rating' => $this->likes->count(),
            'likes' => TopicLikeResource::collection($this->likes),
            'views' => 1,
            'author' => new TopicAuthorResource($this->author),
            'replyPost' => new ReplyPostResource($this->replyPost()),
            'images' => $this->images,
            'files' => $this->files,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
            'updated_at' => Carbon::parse($this->updated_at)->diffForHumans(),
        ];
    }
}
