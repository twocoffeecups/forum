<?php

namespace App\Http\Resources\Client\Notification;

use App\Http\Resources\Client\Forum\TopicResource;
use App\Http\Resources\Client\Post\PostResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class RejectedTopicNotificationResource extends JsonResource
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
            'reason' => $this->isRejected->reason->title,
        ];
    }
}
