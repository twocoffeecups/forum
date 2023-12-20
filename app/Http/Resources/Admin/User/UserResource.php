<?php

namespace App\Http\Resources\Admin\User;

use App\Http\Resources\Admin\Role\RolePermissionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $permissions = $this->permissions;

        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->firstName . " " . $this->lastName,
            'email' => $this->email,
            'role' => $this->role->name,
            'roleId' => $this->role->id,
            'stats' => [
                'topics' => $this->topics->count(),
                'posts' => $this->posts->count(),
                //'reports' => $this->reports->count(),
                'carma' => 0,
            ],
            'permissions' => RolePermissionResource::collection($permissions),
            'inBanList' => false,
            'email_verified_at' => $this->email_verified_at ?? 'No',
            'register_at' => $this->created_at->format("Y-m-d"),
            'topics' => UserTopicResource::collection($this->topics),
            'posts' => $this->posts,
        ];
    }
}
