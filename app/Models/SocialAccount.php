<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'social_accounts';

    protected $fillable = [
        'provider_id',
        'provider',
        'userId',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id', 'userId');
    }
}
