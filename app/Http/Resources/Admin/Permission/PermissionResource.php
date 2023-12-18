<?php

namespace App\Http\Resources\Admin\Permission;

use App\Http\Resources\Admin\Role\RolePermissionResource;
use App\Http\Resources\Admin\Role\RoleUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d'),
            'roles' => $this->roles,
        ];
    }
}
