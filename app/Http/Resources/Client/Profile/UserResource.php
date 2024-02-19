<?php

namespace App\Http\Resources\Client\Profile;

use App\Http\Resources\Forum\Forum\TopicResource;
use App\Http\Resources\Forum\Post\PostResource;
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
        $permissions = $this->permissions()->flatten(1)->pluck('slug');

        return [
            'id' => $this->id,
            'login' => $this->login,
            'name' => $this->name,
            'email' => $this->email,
            'status' => $this->checkOnlineStatus(),
            'lastVisit' => Carbon::parse($this->lastVisit)->diffForHumans(),
            'lastVisitTime' => $this->lastVisit,
            'avatar' => $this->getAvatar(),
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
            'isEmailVerified' => (bool) $this->email_verified_at,
            'register_at' => $this->created_at->format('Y-m-d'),
            'topics' => TopicResource::collection($this->topics->where('status', '=', 1)),
            'unapprovedTopic' => TopicResource::collection($this->unapprovedTopic),
            'posts' => PostResource::collection($this->posts),
            'likes' => PostResource::collection($this->likedPosts),
            'likedTopics' => TopicResource::collection($this->likedTopics),
            'topicBookmarks' => TopicResource::collection($this->topicBookmarks),
            'postBookmarks' => PostResource::collection($this->postBookmarks),
            'unreadNotifications' => NotificationResource::collection($this->unreadNotifications),
            'notifications' => NotificationResource::collection($this->notifications),
        ];
    }
}
