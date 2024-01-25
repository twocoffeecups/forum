<?php

namespace App\Http\Resources\Client\Topic;

use App\Http\Resources\Client\Forum\LatestPostResource;
use App\Http\Resources\Client\Forum\TopicTagResource;
use App\Http\Resources\Client\Post\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ActiveTopicResource extends JsonResource
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
            'author' => $this->author->getFullName(),
            //'latestPost' => new LatestPostResource($this->latestPost()),
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
