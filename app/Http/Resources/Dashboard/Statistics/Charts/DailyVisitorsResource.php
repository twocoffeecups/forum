<?php

namespace App\Http\Resources\Dashboard\Statistics\Charts;

use Illuminate\Http\Resources\Json\JsonResource;

class DailyVisitorsResource extends JsonResource
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
            'label' => $this->date,
            'datasets' => $this->name,
        ];
    }
}
