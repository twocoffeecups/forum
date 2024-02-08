<?php

namespace App\Http\Resources\Forum\Settings;

use App\Http\Resources\Client\Forum\ChildrenForumResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingsResource extends JsonResource
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
            'forumName' => $this->getForumName(),
            //'logo' => $this->getLogoImage(),
            //'background' => $this->getBackgroundImage(),
        ];
    }
}
