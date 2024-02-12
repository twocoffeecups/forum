<?php

namespace App\Http\Resources\Client\Notification;

use Illuminate\Http\Resources\Json\JsonResource;

class PostNotificationResource extends JsonResource
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
            'postId' => $this->id,
            'topicId' => $this->topic->id,
            'topicTitle' => $this->topic->title,
        ];
    }
}
