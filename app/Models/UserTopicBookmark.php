<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTopicBookmark extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'user_topic_bookmarks';
}
