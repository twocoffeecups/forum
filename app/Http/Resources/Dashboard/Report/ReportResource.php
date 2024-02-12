<?php

namespace App\Http\Resources\Dashboard\Report;

use App\Http\Resources\Dashboard\User\UserResource;
use App\Http\Resources\Forum\Post\PostResource;
use App\Http\Resources\Forum\Topic\TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'reason' => $this->reason,
            'type' => $this->object,
            'object' => $this->object == 'topic' ? new TopicResource($this->topic) : new PostResource($this->post),
            'user' => new UserResource($this->user),
            'sender' => new UserResource($this->sender),
            'status' => $this->status,
            'closed' => $this->closed,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
