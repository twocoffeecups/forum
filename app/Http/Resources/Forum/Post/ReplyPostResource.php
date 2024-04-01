<?php

namespace App\Http\Resources\Forum\Post;

use Illuminate\Http\Resources\Json\JsonResource;

class ReplyPostResource extends JsonResource
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
            'message' => $this->message,
            'author' => $this->author->name,
            //'replyPost' => $this->replyPost(),
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
        ];
    }
}
