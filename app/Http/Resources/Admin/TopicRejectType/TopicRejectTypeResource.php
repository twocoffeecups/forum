<?php

namespace App\Http\Resources\Admin\TopicRejectType;

use App\Http\Resources\Admin\Role\RolePermissionResource;
use App\Http\Resources\Admin\Role\RoleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TopicRejectTypeResource extends JsonResource
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
            'description' => $this->description,
            'author' => $this->author->getFullName(),
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
