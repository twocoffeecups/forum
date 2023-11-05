<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'topics';

    public function forum(){
        return $this->belongsTo(Forum::class, 'forumId', 'id');
    }

    public function tags(){
        return $this->belongsToMany(Tag::class, 'topic_tags', 'topicId', 'tagId');
    }

    public function author(){
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
