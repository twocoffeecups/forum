<?php

namespace App\Http\Resources\Admin\Report;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportReasonResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'author' => $this->author,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ];
    }
}
