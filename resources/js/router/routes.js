import Admin from "../layouts/Admin.vue";
import Client from "../layouts/Client.vue";
import Auth from "../layouts/Auth.vue";
import Middleware from "../middleware";

const routes = [
    // Client
    {
        path: '/',
        name: 'main',
        component: () => import('../views/client/Main.vue'),
        meta: {
            layout: Client,
        }
    },
    {
        path: '/forum/:id',
        name: 'forum',
        component: () => import('../views/client/Forum.vue'),
        meta: {
            layout: Client,
        }
    },
    {
        path: '/create-topic',
        name: 'topic.create',
        component: () => import('../views/client/CreateTopic.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        }
    },
    {
        path: '/edit-topic/:id',
        name: 'topic.edit',
        component: () => import('../views/client/EditTopic.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        }
    },
    {
        path: '/topic/:id',
        name: 'topic',
        component: () => import('../views/client/Topic.vue'),
        meta: {
            layout: Client,
        }
    },
    {
        path: '/unapproved-topic/:id',
        name: 'topic.unapproved',
        component: () => import('../views/client/UnapprovedTopic.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        }
    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import('../views/client/Profile.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        },
        children: [
            {path: '', name: 'profile.details', component: () => import('../views/client/ProfileDetails.vue')},

            /** TODO: сделать уведомления */
            // {
            //     path: 'notification',
            //     name: 'profile.notification',
            //     component: () => import('../views/client/ProfileNotification.vue'),
            // },
            {
                path: 'edit',
                name: 'profile.edit',
                component: () => import('../views/client/EditProfile.vue'),
            },
        ],
    },
    {
        path: '/user/:id',
        name: 'user.profile',
        component: () => import('../views/client/UserProfile.vue'),
        meta: {
            layout: Client,
        }
    },

    //  Admin
    {
        path: '/admin',
        name: 'admin',
        component: () => import('../views/admin/Dashboard.vue'),
        meta: {
            layout: Admin,
            middleware: [Middleware.canReadAdminDashboard],
        },

        children: [
            {path: '', name: 'admin.index', component: () => import('../views/admin/Main.vue')},
            {
                path: 'users',
                name: 'admin.users',
                component: () => import('../views/admin/Users.vue'),
            },
            {
                path: 'users/:id',
                name: 'admin.user.details',
                component: () => import('../views/admin/UserDetails.vue'),
            },
            {
                path: 'role',
                name: 'admin.role',
                component: () => import('../views/admin/Role.vue'),
            },
            {
                path: 'role/:id',
                name: 'admin.role.details',
                component: () => import('../views/admin/RoleDetails.vue'),
            },
            {
                path: 'permission',
                name: 'admin.permission',
                component: () => import('../views/admin/Permission.vue'),
            },
            {
                path: 'forum',
                name: 'admin.forum',
                component: () => import('../views/admin/Forum.vue'),
            },
            {
                path: 'forums-tree',
                name: 'admin.forumsTree',
                component: () => import('../views/admin/ForumsTree.vue'),
            },
            {
                path: 'forum/:id',
                name: 'admin.forum.details',
                component: () => import('../views/admin/ForumDetails.vue'),
            },
            {
                path: 'tag',
                name: 'admin.tag',
                component: () => import('../views/admin/Tag.vue'),
            },
            {
                path: 'topic',
                name: 'admin.topic',
                component: () => import('../views/admin/Topic.vue'),
            },
            {
                path: 'topic/:id',
                name: 'admin.topic.details',
                component: () => import('../views/admin/TopicDetails.vue'),
            },
            {
                path: 'rejected-topic',
                name: 'admin.topic.rejected',
                component: () => import('../views/admin/RejectedTopic.vue'),
            },
            {
                path: 'reject-type',
                name: 'admin.reject-type',
                component: () => import('../views/admin/TopicRejectType.vue'),
            },
            {
                path: 'reports',
                name: 'admin.reports',
                component: () => import('../views/admin/Report.vue'),
            },
            {
                path: 'reports/:id',
                name: 'admin.report.details',
                component: () => import('../views/admin/ReportDetails.vue'),
            },
        ],
    },


    // Auth
    {
        path: '/sign-in',
        name: 'auth.signIn',
        component: () => import('../views/auth/SignIn.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/sign-up',
        name: 'auth.signUp',
        component: () => import('../views/auth/SignUp.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/forgot-password',
        name: 'auth.forgotPassword',
        component: () => import('../views/auth/ForgotPassword.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/reset-password/:hash',
        name: 'auth.resetPassword',
        component: () => import('../views/auth/ResetPassword.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/:catchAll(.*)',
        name: 'error.404',
        component: () => import('../views/auth/404.vue'),
        meta: {
            layout: Auth,
        },
    },
];

export default routes;
