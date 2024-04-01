<?php

namespace App\Http\Resources\Client\Profile;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $typeArray = explode('\\', $this->type);
        return [
            'id' => $this->id,
            //'type' => $this->type,
            'type' => end($typeArray),
            'data' => $this->data,
            'readAT' => $this->read_at,
            'createdAT' => Carbon::parse($this->created_at)->diffForHumans(),
        ];
    }
}
