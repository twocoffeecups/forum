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

/**
 * Language
 */
Route::group(['prefix' => 'language'], function () {
    Route::post('set-locale', \App\Http\Controllers\Language\SetLocaleController::class);
});

/**
 * Admin dashboard routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth:sanctum']], function () {
    /**
     * Forums
     */
    Route::group(['prefix' => 'forum'], function () {
        Route::post('/all', \App\Http\Controllers\Dashboard\Forum\IndexController::class);
        Route::post('/store', \App\Http\Controllers\Dashboard\Forum\StoreController::class)->middleware('permissions:can_create_forum');
        Route::get('/{forum}', \App\Http\Controllers\Dashboard\Forum\ShowController::class);
        Route::patch('/{forum}', \App\Http\Controllers\Dashboard\Forum\UpdateController::class)->middleware('permissions:can_create_forum');
        Route::delete('/{forum}', \App\Http\Controllers\Dashboard\Forum\DeleteController::class)->middleware('permissions:can_delete_forum');
        Route::patch('/{forum}/change-status', \App\Http\Controllers\Dashboard\Forum\ChangeStatusController::class)->middleware('permissions:can_update_forum');
        Route::patch('/{forum}/change-parent-forum', \App\Http\Controllers\Dashboard\Forum\ChangePagerForumController::class)->middleware('permissions:can_update_forum');
        Route::patch('/{forum}/change-type', \App\Http\Controllers\Dashboard\Forum\ChangeTypeController::class)->middleware('permissions:can_update_forum');
        Route::get('/forum-tree', \App\Http\Controllers\Dashboard\Forum\GetFormResourceController::class);
    });

    /**
     * Tags
     */
    Route::group(['prefix' => 'tag'], function () {
        Route::post('/', \App\Http\Controllers\Dashboard\Tag\IndexController::class);
        Route::post('/store', \App\Http\Controllers\Dashboard\Tag\StoreController::class)
            ->middleware('permissions:can_create_tag');
        Route::get('/{tag}', \App\Http\Controllers\Dashboard\Tag\ShowController::class);
        Route::patch('/{tag}', \App\Http\Controllers\Dashboard\Tag\UpdateController::class)->middleware('permissions:can_update_tag');
        Route::delete('/{tag}', \App\Http\Controllers\Dashboard\Tag\DeleteController::class)->middleware('permissions:can_delete_tag');
        Route::patch('/{tag}/status', \App\Http\Controllers\Dashboard\Tag\ChangeStatusController::class)->middleware('permissions:can_update_tag');
    });

    /**
     * Topics
     */
    Route::group(['prefix' => 'topic'], function () {
        Route::post('/', \App\Http\Controllers\Dashboard\Topic\IndexController::class);
        Route::get('reject-types', \App\Http\Controllers\Dashboard\Topic\GetRejectTypesController::class);
        Route::post('/store', \App\Http\Controllers\Dashboard\Topic\StoreController::class)->middleware('permissions:can_create_topic');;
        Route::get('/{topic}', \App\Http\Controllers\Dashboard\Topic\ShowController::class);
        Route::patch('/{topic}/resolve', \App\Http\Controllers\Dashboard\Topic\ResolveController::class)->middleware('permissions:can_resolve_topic');
        Route::post('/{topic}/reject', \App\Http\Controllers\Dashboard\Topic\RejectController::class)->middleware('permissions:can_reject_topic');
        Route::delete('/{topic}', \App\Http\Controllers\Dashboard\Topic\DeleteController::class)->middleware('permissions:can_delete_topic');
    });
    Route::post('/rejected-topics', \App\Http\Controllers\Dashboard\Topic\GetRejectedTopicController::class);


    Route::group(['prefix' => 'topic-reject-type'], function () {
        Route::post('/', \App\Http\Controllers\Dashboard\TopicRejectType\IndexController::class);
        Route::post('/store', \App\Http\Controllers\Dashboard\TopicRejectType\StoreController::class)->middleware('permissions:can_create_topic_reject_type');;
        Route::get('/{rejectType}', \App\Http\Controllers\Dashboard\TopicRejectType\ShowController::class);
        Route::post('/{rejectType}', \App\Http\Controllers\Dashboard\TopicRejectType\UpdateController::class)->middleware('permissions:can_create_topic_reject_type');;
        Route::delete('/{rejectType}', \App\Http\Controllers\Dashboard\TopicRejectType\DeleteController::class)->middleware('permissions:can_delete_topic_reject_type');;
        Route::patch('/{rejectType}/change-status', \App\Http\Controllers\Dashboard\TopicRejectType\ChangeStatusController::class)->middleware('permissions:can_update_topic_reject_type');;
    });

    /**
     * Report reason types
     */
    Route::group(['prefix' => 'report-reason-type'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\ReportReasonTypes\ReportReasonTypeController::class, 'index']);
        Route::get('/for-form', [\App\Http\Controllers\Dashboard\ReportReasonTypes\ReportReasonTypeController::class, 'allForForm']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\ReportReasonTypes\ReportReasonTypeController::class, 'store'])->middleware('permissions:can_create_report_reason_type');
        Route::get('/{reportReason}', [\App\Http\Controllers\Dashboard\ReportReasonTypes\ReportReasonTypeController::class, 'show']);
        Route::patch('/{reportReason}', [\App\Http\Controllers\Dashboard\ReportReasonTypes\ReportReasonTypeController::class, 'update'])->middleware('permissions:can_update_report_reason_type');
        Route::delete('/{reportReason}', [\App\Http\Controllers\Dashboard\ReportReasonTypes\ReportReasonTypeController::class, 'delete'])->middleware('permissions:can_delete_report_reason_type');
        Route::patch('/{reportReason}/change-status', [\App\Http\Controllers\Dashboard\ReportReasonTypes\ReportReasonTypeController::class, 'status'])->middleware('permissions:can_update_report_reason_type');
    });

    /**
     * Reports
     */
    Route::group(['prefix' => 'report'], function () {
        Route::post('/', \App\Http\Controllers\Dashboard\Report\IndexController::class);
        Route::get('/{report}', \App\Http\Controllers\Dashboard\Report\ShowController::class);
        Route::post('/{report}/reject', \App\Http\Controllers\Dashboard\Report\ReportRejectController::class)->middleware('permissions:can_reject_report');
        Route::post('/{report}/processing', \App\Http\Controllers\Dashboard\Report\ReportProcessingController::class)->middleware('permissions:can_process_report');
    });

    /**
     * Users
     */
    Route::group(['prefix' => 'user'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\User\UserController::class, 'index']);
        Route::post('/register', [\App\Http\Controllers\Dashboard\User\UserController::class, 'register'])->middleware('permissions:can_create_user');
        Route::get('/roles', \App\Http\Controllers\Dashboard\User\GetRoleController::class);

        Route::group(['prefix' => '{user}'], function () {
            Route::get('/', [\App\Http\Controllers\Dashboard\User\UserController::class, 'show']);
            Route::put('/update', \App\Http\Controllers\Dashboard\User\UpdateProfileController::class)->middleware('permissions:can_update_user');
            Route::patch('/change-avatar', \App\Http\Controllers\Dashboard\User\ChangeAvatarController::class)->middleware('permissions:can_update_user');
            Route::patch('/{role}/change-role', \App\Http\Controllers\Dashboard\User\RoleController::class)->middleware('permissions:can_change_user_role');
            Route::put('/change-permissions', [\App\Http\Controllers\Dashboard\User\PermissionController::class, 'changePermission'])->middleware('permissions:can_change_user_permission');
        });
    });

    /**
     * Ban list
     */
    Route::group(['prefix' => 'ban-list'], function () {
        Route::post('/', \App\Http\Controllers\Dashboard\BanList\IndexController::class);
    });

    /**
     * Roles
     */
    Route::group(['prefix' => 'role'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'index']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'store'])->middleware('permissions:can_create_role');
        Route::get('/{role}', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'show']);
        Route::patch('/{role}', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'update'])->middleware('permissions:can_update_role');
        Route::delete('/{role}', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'delete'])->middleware('permissions:can_delete_role');
        Route::post('/{role}/status', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'status'])->middleware('permissions:can_update_role');
        Route::put('/{role}/change-permissions', [\App\Http\Controllers\Dashboard\Role\RoleController::class, 'changePermissions'])->middleware('permissions:can_change_role_permission');
    });

    /**
     * Permissions
     */
    Route::group(['prefix' => 'permission'], function () {
        Route::post('/', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'index']);
        Route::get('/permission-for-form', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'getPermissionsForForm']);
        Route::post('/store', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'store'])->middleware('permissions:can_create_permission');
        Route::get('/{permission}', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'show']);
        Route::patch('/{permission}', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'update'])->middleware('permissions:can_update_permission');
        Route::delete('/{permission}', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'delete'])->middleware('permissions:can_delete_permission');
        Route::post('/{permission}/status', [\App\Http\Controllers\Dashboard\Permission\PermissionController::class, 'status'])->middleware('permissions:can_update_permission');
    });

    /**
     * Statistics
     */
    Route::group(['prefix' => 'statistics'], function () {
        Route::get('/', \App\Http\Controllers\Dashboard\Statistics\IndexController::class);
    });

    /**
     * Settings
     */
    Route::group(['prefix' => 'settings'], function () {
        Route::get('/get-all', \App\Http\Controllers\Dashboard\Setting\SettingController::class);
        /** Forum name */
        Route::group(['prefix' => 'forum-name'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\General\ForumName\ChangeForumNameController::class)->middleware('permissions:can_update_settings');
        });
        /** Forum meta (description, keywords) */
        Route::group(['prefix' => 'meta'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\General\Meta\ChangeMetaController::class)->middleware('permissions:can_update_settings');
        });
        /** Max posts on topic page */
        Route::patch('/posts-on-page', \App\Http\Controllers\Dashboard\Setting\Topic\ChangePostsOnPageController::class)->middleware('permissions:can_update_settings');
        /** Max topics on forum page */
        Route::patch('/topics-on-page', \App\Http\Controllers\Dashboard\Setting\Topic\ChangeTopicOnPageController::class)->middleware('permissions:can_update_settings');
        /** Logo */
        Route::group(['prefix' => 'logo'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\Styles\Logo\UpdateLogoController::class)->middleware('permissions:can_update_settings');
        });
        /** Background */
        Route::group(['prefix' => 'background'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\Styles\Background\UpdateBackgroundController::class)->middleware('permissions:can_update_settings');
        });
        /** Show only logo */
        Route::group(['prefix' => 'show-only-logo'], function () {
            Route::patch('/', \App\Http\Controllers\Dashboard\Setting\General\ForumName\DontShowForumNameController::class)->middleware('permissions:can_update_settings');
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
                Route::get('/edit', [\App\Http\Controllers\Client\Topic\TopicController::class, 'edit']);
                Route::put('/', \App\Http\Controllers\Client\Topic\UpdateController::class);
            });
            // is user not banned
            Route::group(['middleware' => 'isNotBanList'], function () {
                Route::post('/', \App\Http\Controllers\Client\Topic\StoreController::class)
                    ->middleware('permissions:can_create_topic');
                Route::group(['prefix' => '{topic}/post'], function () {
                    Route::post('/', \App\Http\Controllers\Client\Post\StoreController::class)
                        ->middleware('permissions:can_create_post');
                    Route::patch('/', \App\Http\Controllers\Client\Post\UpdateController::class);
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
        Route::get('/', \App\Http\Controllers\Client\Topic\ShowController::class)->middleware('show.topic:{topic}');
//        Route::get('/edit', [\App\Http\Controllers\Client\Topic\TopicController::class, 'edit']);
//        Route::put('/', \App\Http\Controllers\Client\Topic\UpdateController::class);
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

Route::get('/authorize/{provider}/redirect', [\App\Http\Controllers\Api\Auth\SocialAuthController::class, 'redirectToProvider'])->name('api.social.redirect');
Route::get('/authorize/{provider}/callback', [\App\Http\Controllers\Api\Auth\SocialAuthController::class, 'handleProviderCallback'])->name('api.social.callback');
