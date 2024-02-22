<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;
    protected $table = 'roles';

    public static function getAdminRole()
    {
        return self::where('slug', '=', 'admin')->first();
    }

    public static function getModerRole()
    {
        return self::where('slug', '=', 'moderator')->first();
    }

    public static function getUserRole()
    {
        return self::where('slug', '=', 'user')->first();
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'roleId', 'permissionId');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'roleId', 'id');
    }
}
