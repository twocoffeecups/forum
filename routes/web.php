<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

/**
 *  Dashboard spa route
 */
Route::group(['prefix' => 'admin', 'middleware' => 'canReadAdminDashboard'], function () {
    Route::get('/{page?}', [\App\Http\Controllers\DashboardController::class, 'index'])
        ->where('page', '.*');
});

/**
 * Forum spa route
 */
Route::get('{page}', \App\Http\Controllers\Forum\Main\IndexController::class)
    ->where('page', '(.*)')
    ->name('forum.main')
    ->middleware('daily.visitors');


