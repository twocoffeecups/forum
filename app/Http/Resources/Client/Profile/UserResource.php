<?php

namespace App\Http\Resources\Client\Profile;

use App\Http\Resources\Client\Forum\TopicResource;
use App\Http\Resources\Client\Post\PostResource;
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
        $permissions = $this->permissions()->flatten(1)->pluck('slug');

        return [
            'id' => $this->id,
            'login' => $this->login,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'name' => $this->firstName . ' ' . $this->lastName,
            'email' => $this->email,
            'avatar' => $this->avatar,
            'phone' => $this->phone,
            'role' => $this->role->slug,
            'permissions' => $permissions,
            'canReadAdminDashboard' => $this->canReadAdminDashboard(),
            'stats' => [
                'topics' => $this->topics->count(),
                'posts' => $this->posts->count(),
                'carma' => 1,
            ],
            'isBanned' => $this->isBanned(),
            'banDetails' => $this->banDetails(),
            'emailVerified_at' => $this->email_verified_at->format('Y-m-d'),
            'register_at' => $this->created_at->format('Y-m-d'),
            'topics' => TopicResource::collection($this->topics->where('status', '=', 1)),
            'unapprovedTopic' => TopicResource::collection($this->unapprovedTopic),
            'posts' => PostResource::collection($this->posts),
            'likes' => PostResource::collection($this->likedPosts),
            'likedTopics' => TopicResource::collection($this->likedTopics),
            'topicBookmarks' => TopicResource::collection($this->topicBookmarks),
            'postBookmarks' => PostResource::collection($this->postBookmarks),
        ];
    }
}
