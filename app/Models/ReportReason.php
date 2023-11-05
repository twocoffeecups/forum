<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportReason extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'report_reasons';

    protected function author()
    {
        return $this->belongsTo(User::class, 'authorId', 'id');
    }
}
