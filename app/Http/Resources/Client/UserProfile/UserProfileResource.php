<?php

namespace App\Http\Resources\Client\UserProfile;

use App\Http\Resources\Client\Forum\TopicResource;
use App\Http\Resources\Client\Post\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class UserProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $permissions = $this->permissions()->flatten(1)->pluck('slug');

        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->getFullname(),
            'email' => $this->email,
            'avatar' => $this->avatar, // TODO: сделать аватар по умолчанию
            'role' => $this->role->slug,
            'status' => $this->checkOnlineStatus(),
            'lastVisit' => Carbon::parse($this->lastVisit)->diffForHumans(),
            'stats' => [
                'topics' => $this->topics->count(),
                'posts' => $this->posts->count(),
                'carma' => 0,
            ],
            'register_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
