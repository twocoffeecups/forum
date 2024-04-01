<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostFile extends Model
{
    use HasFactory;

    protected $guarded = false;
    protected $table = 'post_files';
}
