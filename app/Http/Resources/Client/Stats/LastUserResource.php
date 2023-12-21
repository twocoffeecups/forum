<?php

namespace App\Http\Resources\Client\Stats;

use App\Http\Resources\Client\Forum\ChildrenForumResource;
use App\Http\Resources\Client\Forum\TopicResource;
use Illuminate\Http\Resources\Json\JsonResource;

class LastUserResource extends JsonResource
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
            'name' => $name = $this->firstName ." ".$this->lastName ?? $this->login,
        ];
    }
}
