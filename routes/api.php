<?php

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

// admin dashboard routes
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum']], function () {
//Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'forum'], function () {
        Route::post('/all', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'store']);
        Route::get('/{forum}', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'show']);
        Route::patch('/{forum}', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'update']);
        Route::delete('/{forum}', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'delete']);
        Route::patch('/{forum}/change-status', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'status']);
        Route::patch('/{forum}/change-parent-forum', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'changeParentForum']);
        Route::patch('/{forum}/change-type', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'changeForumType']);
        Route::get('/forum-tree', [\App\Http\Controllers\Admin\Forum\ForumController::class, 'forumFormTree']);
    });

    Route::group(['prefix' => 'tag'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Forum\TagController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\Forum\TagController::class, 'store'])
            ->middleware('permissions:can-create-tag');
        Route::get('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'show']);
        Route::patch('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'update']);
        Route::delete('/{tag}', [\App\Http\Controllers\Admin\Forum\TagController::class, 'delete']);
        Route::patch('/{tag}/status', [\App\Http\Controllers\Admin\Forum\TagController::class, 'status']);
    });

    Route::group(['prefix' => 'topic'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Topic\TopicController::class, 'index']);
        Route::get('/{topic}', [\App\Http\Controllers\Admin\Topic\TopicController::class, 'show']);
        Route::patch('/{topic}/resolve', [\App\Http\Controllers\Admin\Topic\TopicController::class, 'resolve']);
        Route::post('/{topic}/reject', [\App\Http\Controllers\Admin\Topic\TopicController::class, 'reject']);
        Route::delete('/{topic}', [\App\Http\Controllers\Admin\Topic\TopicController::class, 'delete']);
    });
    Route::get('/rejected-topics', [\App\Http\Controllers\Admin\Topic\TopicController::class, 'rejectedTopic']);

    Route::group(['prefix' => 'topic-reject-type'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\TopicRejectType\TopicRejectTypeController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\TopicRejectType\TopicRejectTypeController::class, 'store']);
        Route::get('/{rejectType}', [\App\Http\Controllers\Admin\TopicRejectType\TopicRejectTypeController::class, 'show']);
        Route::post('/{rejectType}', [\App\Http\Controllers\Admin\TopicRejectType\TopicRejectTypeController::class, 'update']);
        Route::delete('/{rejectType}', [\App\Http\Controllers\Admin\TopicRejectType\TopicRejectTypeController::class, 'delete']);
        Route::patch('/{rejectType}/change-status', [\App\Http\Controllers\Admin\TopicRejectType\TopicRejectTypeController::class, 'status']);
    });

    Route::group(['prefix' => 'report-reason-type'], function () {
        Route::post('/', [\App\Http\Controllers\Admin\Report\ReportReasonTypeController::class, 'index']);
        Route::get('/for-form', [\App\Http\Controllers\Admin\Report\ReportReasonTypeController::class, 'allForForm']);
        Route::post('/store', [\App\Http\Controllers\Admin\Report\ReportReasonTypeController::class, 'store']);
        Route::get('/{reportReason}', [\App\Http\Controllers\Admin\Report\ReportReasonTypeController::class, 'show']);
        Route::patch('/{reportReason}', [\App\Http\Controllers\Admin\Report\ReportReasonTypeController::class, 'update']);
        Route::delete('/{reportReason}', [\App\Http\Controllers\Admin\Report\ReportReasonTypeController::class, 'delete']);
        Route::patch('/{reportReason}/change-status', [\App\Http\Controllers\Admin\Report\ReportReasonTypeController::class, 'status']);
    });

    Route::group(['prefix' => 'report'], function () {
        Route::post('/', [\App\Http\Controllers\Admin\Report\ReportController::class, 'index']);
        Route::get('/{report}', [\App\Http\Controllers\Admin\Report\ReportController::class, 'show']);
        Route::post('/{report}/reject', [\App\Http\Controllers\Admin\Report\ReportController::class, 'reject']);
        Route::post('/{report}/processing', [\App\Http\Controllers\Admin\Report\ReportController::class, 'processing']);
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\User\UserController::class, 'index']);
        Route::post('/register', [\App\Http\Controllers\Admin\User\UserController::class, 'register']);
        Route::get('/{user}', [\App\Http\Controllers\Admin\User\UserController::class, 'show']);

        Route::group(['prefix' => '{user}'], function () {
            Route::patch('/{role}/change-role', \App\Http\Controllers\Admin\User\RoleController::class);
            Route::put('/change-permissions', [\App\Http\Controllers\Admin\User\PermissionController::class, 'changePermission']);
        });
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Role\RoleController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Admin\Role\RoleController::class, 'store']);
        Route::get('/{role}', [\App\Http\Controllers\Admin\Role\RoleController::class, 'show']);
        Route::patch('/{role}', [\App\Http\Controllers\Admin\Role\RoleController::class, 'update']);
        Route::delete('/{role}', [\App\Http\Controllers\Admin\Role\RoleController::class, 'delete']);
        Route::post('/{role}/status', [\App\Http\Controllers\Admin\Role\RoleController::class, 'status']);
        Route::put('/{role}/change-permissions', [\App\Http\Controllers\Admin\Role\RoleController::class, 'changePermissions']);
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', [\App\Http\Controllers\Admin\Permission\PermissionController::class, 'index']);
        Route::get('/permission-for-form', [\App\Http\Controllers\Admin\Permission\PermissionController::class, 'getPermissionsForForm']);
        Route::post('/', [\App\Http\Controllers\Admin\Permission\PermissionController::class, 'store']);
        Route::get('/{permission}', [\App\Http\Controllers\Admin\Permission\PermissionController::class, 'show']);
        Route::patch('/{permission}', [\App\Http\Controllers\Admin\Permission\PermissionController::class, 'update']);
        Route::delete('/{permission}', [\App\Http\Controllers\Admin\Permission\PermissionController::class, 'delete']);
        Route::post('/{permission}/status', [\App\Http\Controllers\Admin\Permission\PermissionController::class, 'status']);
    });


});

// Client routes
Route::group(['prefix' => 'client'], function () {
    Route::get('/profile', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'index'])->middleware('auth:sanctum');


    // User auth api routes
    Route::group(['prefix' => '{user}', 'middleware' => 'auth:sanctum'], function () {
        // Get user profile details
        Route::get('/profile-details', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'index']);

        // Edit profile
        Route::group(['prefix' => 'profile'], function () {
            Route::put('/profile-update', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'update']);
            Route::put('/edit-password', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'updatePassword']);
            Route::patch('/update-avatar', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'updateAvatar']);
        });
    });

    // auth user topic routes
    Route::group(['prefix' => 'topic'], function () {

        Route::group(['middleware' => 'auth:sanctum'], function () {

            Route::group(['prefix' => '{topic}'], function () {
                Route::patch('/like', [\App\Http\Controllers\Client\Topic\TopicController::class, 'like']);
                Route::patch('/bookmarks', [\App\Http\Controllers\Client\Topic\TopicController::class, 'addToBookmarks']);
            });

            // is user not banned
            Route::group(['middleware' => 'isNotBanList'], function () {
                Route::post('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'store'])
                    ->middleware('permissions:can-create-topic');
                Route::group(['prefix' => '{topic}/post'], function () {
                    Route::post('/', [\App\Http\Controllers\Client\Post\PostController::class, 'store'])
                        ->middleware('permissions:can-create-post');
                    Route::patch('/', [\App\Http\Controllers\Client\Post\PostController::class, 'update']);
                });
            });
        });


        // resources for created and updated form
        Route::get('/form-resources', [\App\Http\Controllers\Client\Topic\TopicController::class, 'createFormResources']);
        Route::get('/tags', [\App\Http\Controllers\Client\Topic\TopicController::class, 'createFormResources']);
    });

    Route::group(['prefix' => 'post/{post}'], function () {
        Route::patch('/bookmarks', [\App\Http\Controllers\Client\Post\PostController::class, 'bookmarks']);
        Route::patch('/like', [\App\Http\Controllers\Client\Post\PostController::class, 'like']);
    });

    // TODO: создать маршкруты типа /api/forum
    // Forum api routes
    Route::group(['prefix' => 'forum'], function () {

        Route::get('/', [\App\Http\Controllers\Client\Forum\ForumCategoryController::class, 'index']);
        //Route::get('/forum-tree', [\App\Http\Controllers\Client\Forum\ForumCategoryController::class, 'getForumTree']);

        Route::group(['prefix' => '{forum}'], function () {
            Route::get('/', \App\Http\Controllers\Client\Forum\ForumController::class);
            Route::post('/topics', \App\Http\Controllers\Client\Forum\ForumTopicController::class);
        });
    });

    // Report
    Route::group(['prefix' => 'report'], function () {
        Route::get('/', \App\Http\Controllers\Client\Report\ReportController::class);
        Route::post('/', \App\Http\Controllers\Client\Report\SendReportController::class)->middleware('auth:sanctum');
    });

    // members profile
    Route::group(['prefix' => 'user-profile/{user}'], function () {
        Route::get('/', [\App\Http\Controllers\Client\UserProfile\UserProfileController::class, 'index']);
        Route::post('/topics', [\App\Http\Controllers\Client\UserProfile\UserProfileController::class, 'getUserTopics']);
        Route::post('/posts', [\App\Http\Controllers\Client\UserProfile\UserProfileController::class, 'getUserPosts']);
    });

    // TODO: создать маршкруты типа /api/forum
    // Forum stats
    Route::get('/forum-stats', \App\Http\Controllers\Client\Forum\ForumStatsController::class);
    Route::get('/active-topics', \App\Http\Controllers\Client\Topic\ActiveTopicsController::class);

    // TODO: создать маршкруты типа /api/forum
    // topics
    Route::group(['prefix' => 'topic'], function () {
        Route::get('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'index']);
        Route::group(['prefix' => '{topic}'], function () {
            Route::get('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'show']);
            Route::get('/edit', [\App\Http\Controllers\Client\Topic\TopicController::class, 'edit']);
            Route::put('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'update']);
            Route::delete('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'delete']);
            Route::group(['prefix' => 'posts'], function () {
                Route::get('/', [\App\Http\Controllers\Client\Topic\TopicPostController::class, 'index']);
            });

        });
    });

    // Unapproved topics
    Route::group(['prefix' => 'unapproved-topic'], function () {
        Route::get('/{topic}', [\App\Http\Controllers\Client\Topic\UnapprovedTopicController::class, 'show'])->middleware('auth:sanctum');
    });

});

// auth for rest api
Route::group(['prefix' => 'auth'], function () {

    Route::post('/sign-up', \App\Http\Controllers\Api\Auth\RegisterController::class);
    Route::post('/sign-in', \App\Http\Controllers\Api\Auth\LoginController::class);
    //Route::post('/logout', \App\Http\Controllers\Api\Auth\LogoutController::class);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::post('/logout', \App\Http\Controllers\Api\Auth\LogoutController::class);
    });

    Route::get('/email/verify/{id}/{hash}', [\App\Http\Controllers\Api\Auth\VerificationController::class, 'verify'])->name('verify.email');
    Route::get('/email/resend', [\App\Http\Controllers\Api\Auth\VerificationController::class, 'resend']);
    Route::post('/password/forgot', \App\Http\Controllers\Api\Auth\ForgotPasswordController::class);
    Route::post('/password/reset', \App\Http\Controllers\Api\Auth\ResetPasswordController::class);


});
