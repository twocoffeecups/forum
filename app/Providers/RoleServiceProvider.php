<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $roles = Role::all();
        foreach ($roles as $role){
            Gate::define($role->slug, function ($user) use ($role){
                return $user->hasRole($role->slug);
            });
        }
    }
}
