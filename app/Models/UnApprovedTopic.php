<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnApprovedTopic extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'un_approved_topics';

    protected function topic()
    {
        return $this->belongsTo(Topic::class, 'topicId', 'id');
    }

    protected function reason()
    {
        return $this->belongsTo(TopicRejectType::class, 'reasonId', 'id');
    }

    protected function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}
