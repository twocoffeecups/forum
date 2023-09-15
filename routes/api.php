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


// Admin dashboard routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum','admin']], function(){
//Route::group(['prefix' => 'admin'], function(){

    Route::group(['prefix' => 'forum'], function(){

        Route::group(['prefix' => 'category'], function(){
            Route::get('/', [\App\Http\Controllers\Admin\Forum\CategoryController::class, 'index']);
            Route::post('/store', [\App\Http\Controllers\Admin\Forum\CategoryController::class, 'store']);
            Route::get('/{category}', [\App\Http\Controllers\Admin\Forum\CategoryController::class, 'show']);
            Route::patch('/{category}', [\App\Http\Controllers\Admin\Forum\CategoryController::class, 'update']);
            Route::delete('/{category}', [\App\Http\Controllers\Admin\Forum\CategoryController::class, 'delete']);
        });

        Route::group(['prefix' => 'tag'], function(){
            Route::get('/', [\App\Http\Controllers\Admin\Forum\TagController::class, 'index']);
            Route::post('/store', [\App\Http\Controllers\Admin\Forum\TagController::class, 'store']);
            Route::get('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'show']);
            Route::patch('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'update']);
            Route::delete('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'delete']);
        });

    });

    Route::group(['prefix' => 'report-type'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\Report\ReportTypeController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Admin\Report\ReportTypeController::class, 'store']);
        Route::get('/{reportType}', [\App\Http\Controllers\Admin\Report\ReportTypeController::class, 'show']);
        Route::patch('/{reportType}', [\App\Http\Controllers\Admin\Report\ReportTypeController::class, 'update']);
        Route::delete('/{reportType}', [\App\Http\Controllers\Admin\Report\ReportTypeController::class, 'delete']);
    });

    Route::group(['prefix' => 'user'], function(){
        Route::post('/register', [\App\Http\Controllers\Admin\User\UserController::class, 'register']);

    });

    Route::group(['prefix' => 'role'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\User\RoleController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Admin\User\RoleController::class, 'store']);
        Route::get('/{role}', [\App\Http\Controllers\Admin\User\RoleController::class, 'show']);
        Route::patch('/{role}', [\App\Http\Controllers\Admin\User\RoleController::class, 'update']);
        Route::delete('/{role}', [\App\Http\Controllers\Admin\User\RoleController::class, 'delete']);
    });


});

// Client routes
Route::group(['prefix' => 'client'], function(){


});

// auth for rest api
Route::group(['prefix' => 'auth'], function(){

    Route::post('/sign-up', \App\Http\Controllers\Api\Auth\RegisterController::class);
    Route::post('/sign-in', \App\Http\Controllers\Api\Auth\LoginController::class);
    Route::group(['middleware'=>'auth:sanctum'], function(){
        Route::post('/logout', \App\Http\Controllers\Api\Auth\LogoutController::class);
    });

    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Api\Auth\VerificationController::class, 'verify'])->name('email.verify');
    Route::get('/email/resend', [\App\Http\Controllers\Api\Auth\VerificationController::class, 'resend']);
    Route::post('/password/forgot', \App\Http\Controllers\Api\Auth\ForgotPasswordController::class);
    Route::post('/password/reset', \App\Http\Controllers\Api\Auth\ResetPasswordController::class);


});
