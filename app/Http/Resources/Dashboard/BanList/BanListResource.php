<?php

namespace App\Http\Resources\Dashboard\BanList;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BanListResource extends JsonResource
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
            'user' =>  new UserResource($this->user),
            'email' => $this->email,
            'reportId' => $this->reportId,
            'banExclude' => $this->banExclude,
            'reason' => new ReportReasonResource($this->reason),
            'banStart' => Carbon::parse($this->banStart)->format("Y-m-d"),
            'banEnd' => Carbon::parse($this->banEnd)->format("Y-m-d"),
        ];
    }
}
