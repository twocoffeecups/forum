<?php

namespace App\Models\Traits\User;

use App\Models\Permission;
use App\Models\Role;

trait UserRolesAndPermissions
{

    /**
     * @return bool
     * check admin role
     */
    public function admin(): bool
    {
        return $this->role->slug === 'admin';
    }

    public function canReadAdminDashboard()
    {
        return (bool) $this->permissions()->where('slug', '=', 'can_read_dashboard')->first();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Role::class, 'roleId', 'id');
    }


    public function permissions()
    {
        $permissions = $this->userPermissions;
        $p = $permissions->merge($this->permissionsThroughRole());
        return $p->unique();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userPermissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class,'user_permissions', 'userId', 'permissionId');
    }

    /**
     * @return mixed
     */
    public function permissionsThroughRole(): mixed
    {
        return $this->role->permissions;
    }

    /**
     * @param string $role
     * @return bool
     * check user role
     */
    public function hasRole(string $role): bool
    {
        return $this->role->slug === $role;
    }

    public function hasRoles(string|array $roles): bool
    {
        foreach ($roles as $role){
            if($this->role->slug === $role){
                return true;
            }
        }
        return false;
    }


    /**
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return (bool) $this->permissions->where('slug', $permission)->count();
    }

    /**
     * @param string $permission
     * @return bool
     */
    public function hasPermissionThroughRole(string $permission): bool
    {

        foreach ($this->role->permissions as $rolePermission){
            if($rolePermission->slug === $permission){
                return true;
            }
        }
        return false;
    }

    /**
     * @param $permission
     * @return bool
     */
    public function hasPermissionTo($permission): bool
    {
        return (bool) $this->hasPermissionThroughRole($permission) || $this->hasPermission($permission);
    }

}
