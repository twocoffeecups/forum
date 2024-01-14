<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportReasonType extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'report_reason_types';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    protected function author(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'authorId', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    protected function reports(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Report::class, 'reasonId', 'id');
    }
}
