<?php

namespace App\Models;

use App\Models\Traits\AdjacencyList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory, AdjacencyList;

    protected $guarded = false;
    protected $table = 'forums';

    public function topics(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Topic::class, 'forumId', 'id');
    }

    public function administrationTopics()
    {
        return $this->topics->where('type', '=', 1);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, Topic::class, 'forumId', 'topicId', 'id', 'id');
    }
    public function allPosts()
    {
        $posts = collect();
        $children = self::allDescendantsAndMe($this);
        foreach ($children as $child){
            $posts->push($child->posts);
        }
        return $posts->flatten(1);
    }

    public function totalPosts()
    {
        return $this->allPosts()->count();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId', 'id');
    }

    public function parent(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Forum::class, 'parentId', 'id');
    }

    public function children(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Forum::class, 'parentId', 'id');
    }

    public function isCategory(): bool
    {
        return $this->type === 0 && $this->parent === null ;
    }

    public function latestPost(): Post|null
    {
        return $this->allPosts()->sortBy('created_at')->last();
    }

}
