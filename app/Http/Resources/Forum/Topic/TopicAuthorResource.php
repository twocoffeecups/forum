<?php

namespace App\Http\Resources\Forum\Topic;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicAuthorResource extends JsonResource
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
            'name' => $this->name,
            'status' => $this->checkOnlineStatus(),
            'lastVisit' => Carbon::parse($this->lastVisit)->diffForHumans(),
            'avatar' => $this->getAvatar(),
            'totalPosts' => $this->posts->count(),
            'register_at' => $this->created_at->format('Y-d-m'),
        ];
    }
}
