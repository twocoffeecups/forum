<?php

namespace App\Http\Resources\Dashboard\Topic;

use Illuminate\Http\Resources\Json\JsonResource;

class RejectedTopicResource extends JsonResource
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
            'topicId' => $this->topicId,
            'title' => $this->topic->title,
            'author' => $this->topic->author->getFullName(),
            'reason' => $this->reason->title,
            'created_at' => $this->created_at->format('Y-m-d'),
            'posts' => $this->topic->posts()->count(),
        ];
    }
}
