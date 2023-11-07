<?php

namespace App\Http\Resources\Client\Topic;

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
            'status' => $this->status,
            'rating' => $this->likes->count(),
            'likes' => $this->likes,
            'forum' => $this->forum,
            'tags' => $this->tags,
            'author' => $this->author,
            'created_at' => $this->created_at,
        ];
    }
}
