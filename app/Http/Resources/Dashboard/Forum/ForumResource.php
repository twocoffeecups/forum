<?php

namespace App\Http\Resources\Dashboard\Forum;

use Illuminate\Http\Resources\Json\JsonResource;

class ForumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type === 0 ? 'Category' : 'Forum',
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d'),
            'stats' => [
                'topics' => $this->topics()->count(),
                'children' => $this->children()->count(),
                'posts' => $this->posts()->count(),
            ],

            'author' => new ForumDetailsAuthorResource($this->author),
            'children' => ForumResource::collection($this->descendantsTree),
        ];
    }
}
