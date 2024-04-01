<?php

namespace App\Http\Resources\Dashboard\Topic;

use Illuminate\Http\Resources\Json\JsonResource;

class TopicDetailsResource extends JsonResource
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
            'forum' => $this->forum->name,
            'author' => $this->author->name,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d'),
            'posts' => $this->posts()->count(),
            'views' => 1,
            'tags' => $this->tags,
            'isRejected' => $this->isRejected,
        ];
    }
}
