<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'admin'], function(){

    Route::group(['prefix' => 'forum'], function(){

        Route::group(['prefix' => 'category'], function(){
            Route::get('/', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'index']);
            Route::post('/store', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'store']);
            Route::get('/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'show']);
            Route::patch('/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'update']);
            Route::delete('/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'delete']);
        });

    });
});
