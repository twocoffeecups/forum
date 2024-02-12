<?php

namespace App\Http\Resources\Dashboard\Settings;

use Illuminate\Http\Resources\Json\JsonResource;

class LogoResource extends JsonResource
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
            'data' => json_decode($this->variableData),
            'updated_at' => $this->updated_at->format('Y-m-d'),
        ];
    }
}
