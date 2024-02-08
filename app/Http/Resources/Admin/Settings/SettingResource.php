<?php

namespace App\Http\Resources\Admin\Settings;

use App\Http\Resources\Client\Forum\ChildrenForumResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return json_decode($this->variableData);
    }
}
