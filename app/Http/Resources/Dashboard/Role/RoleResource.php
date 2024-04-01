<?php

namespace App\Http\Resources\Dashboard\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d'),
            'usersCount' => $this->users->count(),
            'users' => RoleUserResource::collection($this->users),
            'permissions' => RolePermissionResource::collection($this->permissions),
        ];
    }
}
