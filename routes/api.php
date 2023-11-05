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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

// admin routes
//Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum','admin']], function(){
Route::group(['prefix' => 'admin'], function(){

    Route::group(['prefix' => 'forum'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'store']);
        Route::get('/{forum}', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'show']);
        Route::patch('/{forum}', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'update']);
        Route::delete('/{forum}', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'delete']);
    });

    Route::group(['prefix' => 'tag'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\Forum\TagController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\Forum\TagController::class, 'store']);
        Route::get('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'show']);
        Route::patch('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'update']);
        Route::delete('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'delete']);
        Route::post('/{tag}/status', [\App\Http\Controllers\Admin\Forum\TagController::class, 'status']);
    });

    Route::group(['prefix' => 'report-reason'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\Report\ReportReasonController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\Report\ReportReasonController::class, 'store']);
        Route::get('/{reportReason}', [\App\Http\Controllers\Admin\Report\ReportReasonController::class, 'show']);
        Route::patch('/{reportReason}', [\App\Http\Controllers\Admin\Report\ReportReasonController::class, 'update']);
        Route::delete('/{reportReason}', [\App\Http\Controllers\Admin\Report\ReportReasonController::class, 'delete']);
        Route::post('/{reportReason}/status', [\App\Http\Controllers\Admin\Report\ReportReasonController::class, 'status']);
    });

    Route::group(['prefix' => 'user'], function(){
        Route::post('/register', [\App\Http\Controllers\Admin\User\UserController::class, 'register']);

    });

    Route::group(['prefix' => 'role'], function(){
        Route::get('/', [\App\Http\Controllers\Admin\User\RoleController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\User\RoleController::class, 'store']);
        Route::get('/{role}', [\App\Http\Controllers\Admin\User\RoleController::class, 'show']);
        Route::patch('/{role}', [\App\Http\Controllers\Admin\User\RoleController::class, 'update']);
        Route::delete('/{role}', [\App\Http\Controllers\Admin\User\RoleController::class, 'delete']);
        Route::post('/{role}/status', [\App\Http\Controllers\Admin\User\RoleController::class, 'status']);
    });


});

// Client routes
Route::group(['prefix' => 'client'], function(){

    Route::group(['prefix' => 'topic'], function(){
        Route::get('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'store']);
        Route::get('/{topic}', [\App\Http\Controllers\Client\Topic\TopicController::class, 'show']);
        Route::patch('/{topic}', [\App\Http\Controllers\Client\Topic\TopicController::class, 'update']);
        Route::delete('/{topic}', [\App\Http\Controllers\Client\Topic\TopicController::class, 'delete']);
    });

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
