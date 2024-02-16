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

/**
 * Admin dashboard routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum']], function () {
//Route::group(['prefix' => 'admin'], function () {
    /**
     * Forums
     */
    Route::group(['prefix' => 'forum'], function () {
        Route::post('/all', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'index']);
        Route::post('/', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'store']);
        Route::get('/{forum}', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'show']);
        Route::patch('/{forum}', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'update']);
        Route::delete('/{forum}', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'delete']);
        Route::patch('/{forum}/change-status', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'status']);
        Route::patch('/{forum}/change-parent-forum', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'changeParentForum']);
        Route::patch('/{forum}/change-type', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'changeForumType']);
        Route::get('/forum-tree', [\App\Http\Controllers\Dashboard\Forum\ForumController::class, 'forumFormTree']);
    });

    /**
     * Tags
     */
    Route::group(['prefix' => 'tag'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Tag\TagController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\Tag\TagController::class, 'store'])
            ->middleware('permissions:can-create-tag');
        Route::get('/{tag}', [\App\Http\Controllers\Dashboard\Tag\TagController::class, 'show']);
        Route::patch('/{tag}', [\App\Http\Controllers\Dashboard\Tag\TagController::class, 'update']);
        Route::delete('/{tag}', [\App\Http\Controllers\Dashboard\Tag\TagController::class, 'delete']);
        Route::patch('/{tag}/status', [\App\Http\Controllers\Dashboard\Tag\TagController::class, 'status']);
    });

    /**
     * Topics
     */
    Route::group(['prefix' => 'topic'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'index']);
        Route::get('reject-types', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'getRejectTypes']);
        //Route::post('/store', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'store']);
        Route::get('/{topic}', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'show']);
        Route::patch('/{topic}/resolve', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'resolve']);
        Route::post('/{topic}/reject', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'reject']);
        Route::delete('/{topic}', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'delete']);
    });
    Route::post('/rejected-topics', [\App\Http\Controllers\Dashboard\Topic\TopicController::class, 'rejectedTopic']);


    Route::group(['prefix' => 'topic-reject-type'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\TopicRejectType\TopicRejectTypeController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\TopicRejectType\TopicRejectTypeController::class, 'store']);
        Route::get('/{rejectType}', [\App\Http\Controllers\Dashboard\TopicRejectType\TopicRejectTypeController::class, 'show']);
        Route::post('/{rejectType}', [\App\Http\Controllers\Dashboard\TopicRejectType\TopicRejectTypeController::class, 'update']);
        Route::delete('/{rejectType}', [\App\Http\Controllers\Dashboard\TopicRejectType\TopicRejectTypeController::class, 'delete']);
        Route::patch('/{rejectType}/change-status', [\App\Http\Controllers\Dashboard\TopicRejectType\TopicRejectTypeController::class, 'status']);
    });

    /**
     * Report reason types
     */
    Route::group(['prefix' => 'report-reason-type'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Report\ReportReasonTypeController::class, 'index']);
        Route::get('/for-form', [\App\Http\Controllers\Dashboard\Report\ReportReasonTypeController::class, 'allForForm']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\Report\ReportReasonTypeController::class, 'store']);
        Route::get('/{reportReason}', [\App\Http\Controllers\Dashboard\Report\ReportReasonTypeController::class, 'show']);
        Route::patch('/{reportReason}', [\App\Http\Controllers\Dashboard\Report\ReportReasonTypeController::class, 'update']);
        Route::delete('/{reportReason}', [\App\Http\Controllers\Dashboard\Report\ReportReasonTypeController::class, 'delete']);
        Route::patch('/{reportReason}/change-status', [\App\Http\Controllers\Dashboard\Report\ReportReasonTypeController::class, 'status']);
    });

    /**
     * Reports
     */
    Route::group(['prefix' => 'report'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Report\ReportController::class, 'index']);
        Route::get('/{report}', [\App\Http\Controllers\Dashboard\Report\ReportController::class, 'show']);
        Route::post('/{report}/reject', \App\Http\Controllers\Dashboard\Report\ReportRejectController::class);
        Route::post('/{report}/processing', \App\Http\Controllers\Dashboard\Report\ReportProcessingController::class);
    });

    /**
     * Users
     */
    Route::group(['prefix' => 'user'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\User\UserController::class, 'index']);
        Route::post('/register', [\App\Http\Controllers\Dashboard\User\UserController::class, 'register']);


        Route::group(['prefix' => '{user}'], function () {
            Route::get('/', [\App\Http\Controllers\Dashboard\User\UserController::class, 'show']);
            Route::put('/update', \App\Http\Controllers\Dashboard\User\UpdateProfileController::class);
            Route::patch('/change-avatar', \App\Http\Controllers\Dashboard\User\ChangeAvatarController::class);
            Route::patch('/{role}/change-role', \App\Http\Controllers\Dashboard\User\RoleController::class);
            Route::put('/change-permissions', [\App\Http\Controllers\Dashboard\User\PermissionController::class, 'changePermission']);
        });
    });

    /**
     * Roles
     */
    Route::group(['prefix' => 'role'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'store']);
        Route::get('/{role}', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'show']);
        Route::patch('/{role}', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'update']);
        Route::delete('/{role}', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'delete']);
        Route::post('/{role}/status', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'status']);
        Route::put('/{role}/change-permissions', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'changePermissions']);
    });

    /**
     * Permissions
     */
    Route::group(['prefix' => 'permission'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'index']);
        Route::get('/permission-for-form', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'getPermissionsForForm']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'store']);
        Route::get('/{permission}', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'show']);
        Route::patch('/{permission}', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'update']);
        Route::delete('/{permission}', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'delete']);
        Route::post('/{permission}/status', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'status']);
    });

    /**
     * Settings
     */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/get-all', \App\Http\Controllers\Dashboard\Setting\SettingController::class);
        /** Forum name */
        Route::group(['prefix' => 'forum-name'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\General\ForumName\ChangeForumNameController::class);
        });
        /** Forum meta (description, keywords) */
        Route::group(['prefix' => 'meta'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\General\Meta\ChangeMetaController::class);
        });
        /** Max posts on topic page */
        Route::patch('/posts-on-page', \App\Http\Controllers\Dashboard\Setting\Topic\ChangePostsOnPageController::class);
        /** Max topics on forum page */
        Route::patch('/topics-on-page', \App\Http\Controllers\Dashboard\Setting\Topic\ChangeTopicOnPageController::class);
        /** Logo */
        Route::group(['prefix' => 'logo'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\Styles\Logo\UpdateLogoController::class);
        });
        /** Background */
        Route::group(['prefix' => 'background'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\Styles\Background\UpdateBackgroundController::class);
        });
        /** Show only logo */
        Route::group(['prefix' => 'show-only-logo'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\General\ForumName\DontShowForumNameController::class);
        });
    });
});
/**
 * Client routes
 */
Route::group(['prefix' => 'client'], function () {
    Route::get('/profile', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'index'])->middleware('auth:sanctum');

    // User auth api routes
    Route::group(['middleware' => 'auth:sanctum'], function () {
        // Get user profile details
        Route::get('/profile-details', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'index']);
        // Edit profile
        Route::group(['prefix' => 'profile'], function () {
            Route::put('/profile-update', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'update']);
            Route::put('/edit-password', [\App\Http\Controllers\Client\Profile\ProfileController::class, 'updatePassword']);
            Route::patch('/update-avatar', \App\Http\Controllers\Client\Profile\UpdateAvatarController::class);
        });
    });

    // auth user topic routes
    Route::group(['prefix' => 'topic'], function () {
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::group(['prefix' => '{topic}'], function () {
                Route::patch('/like', \App\Http\Controllers\Client\Topic\LikeController::class);
                Route::patch('/bookmarks', \App\Http\Controllers\Client\Topic\BookmarkController::class);
            });
            // is user not banned
            Route::group(['middleware' => 'isNotBanList'], function () {
                Route::post('/', \App\Http\Controllers\Client\Topic\StoreController::class)
                    ->middleware('permissions:can-create-topic');
                Route::group(['prefix' => '{topic}/post'], function () {
                    Route::post('/', [\App\Http\Controllers\Client\Post\StoreController::class, 'store'])
                        ->middleware('permissions:can-create-post');
                    Route::patch('/', [\App\Http\Controllers\Client\Post\UpdateController::class, 'update']);
                });
            });
        });
        // resources for created and updated form
        Route::get('/form-resources', [\App\Http\Controllers\Client\Topic\TopicController::class, 'createFormResources']);
        Route::get('/tags', [\App\Http\Controllers\Client\Topic\TopicController::class, 'createFormResources']);
    });

    Route::group(['prefix' => 'post/{post}'], function () {
        Route::patch('/bookmarks', \App\Http\Controllers\Client\Post\BookmarkController::class);
        Route::patch('/like', \App\Http\Controllers\Client\Post\LikeController::class);
    });
    // Report
    Route::group(['prefix' => 'report'], function () {
        Route::get('/', \App\Http\Controllers\Client\Report\ReportController::class);
        Route::post('/', \App\Http\Controllers\Client\Report\SendReportController::class)->middleware('auth:sanctum');
    });
    // user profile
    Route::group(['prefix' => 'user-profile/{user}'], function () {
        Route::get('/', [\App\Http\Controllers\Client\UserProfile\UserProfileController::class, 'index']);
        Route::post('/topics', [\App\Http\Controllers\Client\UserProfile\UserProfileController::class, 'getUserTopics']);
        Route::post('/posts', [\App\Http\Controllers\Client\UserProfile\UserProfileController::class, 'getUserPosts']);
    });
});

/**
 * Forum routes
 */
Route::group(['prefix' => 'forum'], function () {
    // Forum api routes
    Route::get('/', [\App\Http\Controllers\Client\Forum\ForumCategoryController::class, 'index']);
    Route::group(['prefix' => '{forum}'], function () {
        Route::get('/', \App\Http\Controllers\Client\Forum\ForumController::class);
        Route::post('/topics', \App\Http\Controllers\Client\Forum\ForumTopicController::class);
    });
    Route::post('/search', \App\Http\Controllers\Client\Search\SearchController::class);
    // Forum stats
    Route::group(['prefix' => 'sidebar'], function () {
        Route::get('/stats', \App\Http\Controllers\Client\Forum\ForumStatsController::class);
        Route::get('/active-topics', \App\Http\Controllers\Client\Topic\ActiveTopicsController::class);
    });

    /**
     * Forum settings
     */
//    Route::get('/settings', \App\Http\Controllers\Forum\Settings\SettingController::class);
});
Route::get('/settings', \App\Http\Controllers\Forum\Settings\SettingController::class);
/**
 * Topic routes
 */
Route::group(['prefix' => 'topic'], function () {
    Route::get('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'index']);
    Route::group(['prefix' => '{topic}'], function () {
        Route::get('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'show']);
        Route::get('/edit', [\App\Http\Controllers\Client\Topic\TopicController::class, 'edit']);
        Route::put('/', \App\Http\Controllers\Client\Topic\UpdateController::class);
        Route::delete('/', [\App\Http\Controllers\Client\Topic\TopicController::class, 'delete']);
        Route::group(['prefix' => 'posts'], function () {
            Route::post('/', \App\Http\Controllers\Client\Topic\TopicPostController::class);
        });
    });
    // Unapproved topics
    Route::group(['prefix' => 'unapproved'], function () {
        Route::get('/{topic}', [\App\Http\Controllers\Client\Topic\UnapprovedTopicController::class, 'show'])->middleware('auth:sanctum');
    });
});

/**
 * Auth for rest api routes
 */
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
