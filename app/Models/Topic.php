<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $guarded = false;
    protected $table = 'topics';
    protected $primaryKey = 'id';
    protected $fillable = [
        'forumId',
        'title',
        'content',
        'userId',
        'type',
        'status',
        'private',
        'closeComments'
    ];

    public function forum(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Forum::class, 'forumId', 'id');
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'topic_tags', 'topicId', 'tagId');
    }

    public function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function likes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'topic_likes', 'topicId', 'userId');
    }

    public function bookmarks(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'topic_bookmarks', 'topicId', 'userId');
    }

    public function posts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Post::class, 'topicId', 'id');
    }

    public function latestPost()
    {
        return $this->posts()->latest('created_at')->first();
    }

    public function images()
    {
        return $this->hasMany(TopicImage::class, 'topicId', 'id');
    }

    public function isRejected()
    {
        return $this->hasOne(RejectedTopic::class, 'topicId', 'id');
    }

    public function views(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TopicView::class, 'topicId', 'id');
    }

    public function totalViews(): int
    {
        return (int) $this->views->count();
    }

    public static function allApprovedTopics()
    {
        return self::all()->where('status', '=', '1');
    }

    public function administrationTopic(): bool
    {
        return (bool) $this->type == 1;
    }

    public function commentsClosed(): bool
    {
        return (bool) $this->closeComments == 1;
    }

    public function isPrivate(): bool
    {
        return (bool) $this->private == 1;
    }

    public function accessedUsers(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class, 'private_topic_accessed_users', 'topicId', 'userId');
    }

}
