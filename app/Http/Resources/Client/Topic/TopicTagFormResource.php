<?php

namespace App\Http\Resources\Client\Topic;

use App\Http\Resources\Client\Forum\TopicTagResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicTagFormResource extends JsonResource
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
            'option' => $this->name,
            'value' => $this->id,
        ];
    }
}
