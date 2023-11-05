<?php

namespace App\Models;

use App\Models\trait\AdjacencyList;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Forum extends Model
{
    use HasFactory, SoftDeletes, AdjacencyList;

    protected $guarded = false;
    protected $table = 'forums';

    protected function topics(){
        return $this->hasMany(Topic::class);
    }

    protected function parent(){
        return $this->belongsTo(Forum::class, 'parentId', 'id');
    }

    protected function children(){
        return $this->hasMany(Forum::class, 'parentId', 'id');
    }

    protected function isCategory(){
        return $this->type === 0 && $this->parent === null ;
    }

}
