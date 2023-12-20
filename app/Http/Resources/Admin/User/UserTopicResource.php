<?php

namespace App\Http\Resources\Admin\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTopicResource extends JsonResource
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
            'forum' => $this->forum->name,
            'title' => $this->title,
            'posts' => $this->posts->count(),
            'status' => $this->status,
            'created_at' => $this->created_at->format("Y-m-d"),
            'topics' => $this->topics,

        ];
    }
}
