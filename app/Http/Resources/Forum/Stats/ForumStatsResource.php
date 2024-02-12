<?php

namespace App\Http\Resources\Forum\Stats;

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
