<?php

namespace App\Http\Resources\Client\Forum;

use Illuminate\Http\Resources\Json\JsonResource;

class LatestPostResource extends JsonResource
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
            'author' => new PostAuthorResource($this->author),
            'created_at' => date('d.m.Y H:i', strtotime($this->created_at)),
        ];
    }
}
