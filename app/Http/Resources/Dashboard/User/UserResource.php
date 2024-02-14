<?php

namespace App\Http\Resources\Dashboard\User;

use App\Http\Resources\Dashboard\Role\RolePermissionResource;
use Carbon\Carbon;
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
        $permissions = $this->permissions();

        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->firstName . " " . $this->lastName,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'role' => $this->role->name,
            'roleId' => $this->role->id,
            'status' => $this->checkOnlineStatus(),
            'lastVisit' => Carbon::parse($this->lastVisit)->diffForHumans(),
            'avatar' => $this->getAvatar(),
            'stats' => [
                'topics' => $this->topics->count(),
                'posts' => $this->posts->count(),
                'reports' => $this->reports->count(),
                'carma' => 0,
            ],
            'isWarned' => $this->isWarned(),
            'isBanned' => $this->isBanned(),
            'banDetails' => $this->banDetails(),
            'permissions' => RolePermissionResource::collection($permissions),
            'email_verified_at' => $this->email_verified_at ? $this->email_verified_at->format('Y-m-d') : 'No',
            'register_at' => $this->created_at->format("Y-m-d"),
            'topics' => UserTopicResource::collection($this->topics),
            'posts' => PostResource::collection($this->posts),
            'reports' => ReportResource::collection($this->reports),
        ];
    }
}
