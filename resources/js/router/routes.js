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
            // middleware: [Middleware.userIsBanned],
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
        path: '/profile',
        name: 'profile',
        component: () => import('../views/client/Profile.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        },
        children: [
            {path: '', name: 'profile.detail', component: () => import('../views/client/ProfileDetail.vue')},
            {
                path: 'notification',
                name: 'profile.notification',
                component: () => import('../views/client/ProfileNotification.vue'),
            },
            {
                path: 'edit',
                name: 'profile.edit',
                component: () => import('../views/client/EditProfile.vue'),
            },
        ],
    },

    //  Admin
    {
        path: '/admin',
        name: 'admin',
        component: () => import('../views/admin/Dashboard.vue'),
        meta: {
            layout: Admin,
            middleware: [Middleware.isAdmin]
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
                name: 'admin.userDetail',
                component: () => import('../views/admin/UserDetail.vue'),
            },
            {
                path: 'role',
                name: 'admin.role',
                component: () => import('../views/admin/Role.vue'),
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
                name: 'admin.forumDetail',
                component: () => import('../views/admin/ForumDetail.vue'),
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
                path: 'roles',
                name: 'admin.roles',
                component: () => import('../views/admin/Role.vue'),
            },
            {
                path: 'reports',
                name: 'admin.reports',
                component: () => import('../views/admin/Report.vue'),
            },
            {
                path: 'reports/:id',
                name: 'admin.reportDetail',
                component: () => import('../views/admin/ReportDetail.vue'),
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
        path: '/:pathMatch(.*)*',
        component: () => import('../views/auth/404.vue'),
        name: '404',
        meta: {
            layout: Auth,
        },
    },
];

export default routes;
