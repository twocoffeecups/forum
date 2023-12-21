<?php

namespace App\Http\Resources\Client\Stats;

use App\Http\Resources\Client\Forum\ChildrenForumResource;
use App\Http\Resources\Client\Forum\TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ForumStatsResource extends JsonResource
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
            'topics' => $this->topics,
            'posts' => $this->post,
            'users' => $this->users,
            'lastUser' => $this->lastUser,
        ];
    }
}
