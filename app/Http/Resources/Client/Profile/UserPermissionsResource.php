<?php

namespace App\Http\Resources\Client\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class UserPermissionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return [
//            'permission' => $this->slug,
//        ];

        return [
           $this->slug,
        ];
    }
}
