<?php

namespace App\Http\Resources\Forum\Topic;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class ActiveTopicResource extends JsonResource
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
            'author' => $this->author->name,
            'authorId' => $this->author->id,
            'created_at' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
