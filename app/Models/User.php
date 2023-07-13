<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'login',
        'firstName',
        'lastName',
        'avatar',
        'email',
        'phone',
        'roleId',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function topics(){
        return $this->hasMany(Topic::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function likes(){
        return $this->belongsToMany(Post::class, 'post_likes', 'userId', 'postId');
    }

    public function bookmarks(){
        return $this->belongsToMany(Post::class, 'user_bookmarks', 'userId', 'postId');
    }

    public function notifications(){
        return $this->hasMany(Notification::class, 'userId', 'id');
    }

    /**
     * @return bool
     * check admin role
     */
    public function admin():bool{
        return $this->roleId === 1;
    }
}
