<?php

namespace App\Http\Resources\Client\UserProfile;

use App\Http\Resources\Client\Forum\TopicResource;
use App\Http\Resources\Client\Post\PostResource;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'name' => $this->firstName . ' ' . $this->lastName,
            'email' => $this->email,
            'avatar' => $this->avatar, // TODO: сделать аватар по умолчанию
            'role' => $this->role->slug,
            'stats' => [
                'topics' => $this->topics->count(),
                'posts' => $this->posts->count(),
                'carma' => 0,
            ],
            'register_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
