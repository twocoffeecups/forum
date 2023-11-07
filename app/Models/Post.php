<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'posts';

    public function author(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function topic(){
        return $this->belongsTo(Topic::class, 'topicId', 'id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'postId', 'userId');
    }

    public function rating(){
        return $this->hasMany(PostLike::class)->count();
    }

    public function likesCount(){
        return $this->hasMany(PostLike::class)->sum('postId');
    }

    public function images(){
        return $this->hasMany(PostImage::class);
    }


}
