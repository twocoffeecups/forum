<?php

namespace App\Http\Resources\Admin\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleUserResource extends JsonResource
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
            'login' => $this->login,
            'email' => $this->email,
            'role' => $this->role->name,
            'register_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
