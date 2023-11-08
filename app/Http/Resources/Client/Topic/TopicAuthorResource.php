<?php

namespace App\Http\Resources\Client\Topic;

use App\Http\Resources\Client\Forum\TopicTagResource;
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
            'name' => $this->firstName." ".$this->lastName,
            'status' => 'offline',
            'avatar' => $this->avatar,
            'totalPosts' => $this->posts->count(),
            'register_at' => date('d.m.Y H:i', strtotime($this->created_at)),
        ];
    }
}
