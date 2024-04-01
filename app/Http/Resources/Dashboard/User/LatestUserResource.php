<?php

namespace App\Http\Resources\Dashboard\User;

use App\Http\Resources\Dashboard\Role\RolePermissionResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class LatestUserResource extends JsonResource
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
            'login' => $this->login,
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role->name,
            'status' => $this->checkOnlineStatus(),
            'lastVisit' => Carbon::parse($this->lastVisit)->diffForHumans(),
            'avatar' => $this->getAvatar(),
            'email_verified_at' => $this->email_verified_at ? $this->email_verified_at->format('Y-m-d') : 'No',
            'register_at' => $this->created_at->format("Y-m-d"),
        ];
    }
}
