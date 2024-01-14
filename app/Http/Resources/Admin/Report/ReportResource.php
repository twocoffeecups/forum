<?php

namespace App\Http\Resources\Admin\Report;

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
            'reason' => $this->reason,
            'object' => $this->object == 'topic' ? $this->topic : $this->post,
            'user' => $this->user,
            'sender' => $this->sender,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
