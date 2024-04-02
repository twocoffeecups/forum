<?php

namespace App\Http\Controllers\Api\Dashboard\Permission;

use App\Http\Controllers\Controller;
use App\Models\Permission;

class GetController extends Controller
{
    /**
     * Get permission
     * @param Permission $permission
     * @return object
     */
    public function __invoke(Permission $permission): object
    {
        return response()->json(['permission' => $permission]);
    }
}
