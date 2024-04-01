<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::pluck('id')->toArray();
        $moderatorRole = Role::getModerRole();
        $userRole = Role::getUserRole();
        $adminRole = Role::getAdminRole();
        $adminRole->permissions()->attach($permissions);
        $moderatorRole->permissions()->attach([
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 19, 20, 37, 38, 39, 40,
        ]);
        $userRole->permissions()->attach([
            8, 9, 10, 37, 38, 22,
        ]);
    }
}
