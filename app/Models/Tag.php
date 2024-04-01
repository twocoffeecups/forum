<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'tags';

    protected $fillable = [
        'name',
        'status',
        'description',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'authorId', 'id');
    }

    protected function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_tags', 'topicId', 'tagId');
    }
}
