<?php

namespace App\Http\Resources\Admin\User;

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
        return [
            'id' => $this->id,
            'login' => $this->login,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'name' => $this->firstName . ' ' . $this->lastName,
            'email' => $this->email,
            'phone' => $this->phone,
            'role' => $this->role,
            'stats' => [
                'topics' => $this->topics->count(),
                'posts' => $this->posts->count(),
                'carma' => 0,
            ],
            //'isAdmin' => $this->admin,
            'isBanned' => false,
            'emailVerifiedAt' => $this->email_verified_at,
            'registerAT' => $this->created_at,
            'topics' => $this->topics,
            'posts' => $this->posts,
            'likes' => $this->likes,
            'bookmarks' => $this->bookmarks,
        ];
    }
}
