<?php

namespace App\Http\Resources\Forum\Forum;

use Illuminate\Http\Resources\Json\JsonResource;

class ChildrenForumResource extends JsonResource
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
            'forums' => $this->totalChildrenForums(),
            'posts' => $this->totalPosts(),
            'views' => $this->totalTopicsViews(),
            'latestPost' => $this->latestPost() ? new LatestPostResource($this->latestPost()) : false,
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
        ];
    }
}
