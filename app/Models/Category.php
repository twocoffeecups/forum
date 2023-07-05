<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'categories';

    public function topics(){
        return $this->hasMany(Topic::class);
    }

    public function parent(){
        return $this->belongsTo(Category::class, 'parentId', 'id');
    }

    public function children(){
        return $this->hasMany(Category::class, 'parentId', 'id');
    }
}
