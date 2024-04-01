<?php

namespace App\Http\Resources\Dashboard\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'reason' => $this->reason->name,
            'status' => $this->status,
            'message' => $this->message,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
