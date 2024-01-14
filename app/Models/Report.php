<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'reports';

    public function reason()
    {
        return $this->belongsTo(ReportReasonType::class, 'reasonId', 'id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'topicId', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'postId', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'senderId', 'id');
    }

    public function moder()
    {
        return $this->belongsTo(User::class, 'moderId', 'id');
    }
}
