import Admin from "../../layouts/Admin.vue";
import Client from "../../layouts/Client.vue";
import Auth from "../../layouts/Auth.vue";
import Middleware from "../../middleware";

const routes = [
    // Client
    {
        path: '/',
        name: 'main',
        component: () => import('../../views/client/Main.vue'),
        meta: {
            layout: Client,
        }
    },
    {
        path: '/forum/:id',
        name: 'forum',
        component: () => import('../../views/client/Forum.vue'),
        meta: {
            layout: Client,
        }
    },
    {
        path: '/create-topic',
        name: 'topic.create',
        component: () => import('../../views/client/CreateTopic.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        }
    },
    {
        path: '/edit-topic/:id',
        name: 'topic.edit',
        component: () => import('../../views/client/EditTopic.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        }
    },
    {
        path: '/topic/:id',
        name: 'topic',
        component: () => import('../../views/client/Topic.vue'),
        meta: {
            layout: Client,
        }
    },
    {
        path: '/unapproved-topic/:id',
        name: 'topic.unapproved',
        component: () => import('../../views/client/UnapprovedTopic.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        }
    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import('../../views/client/Profile.vue'),
        meta: {
            layout: Client,
            middleware: [Middleware.auth],
        },
        children: [
            {path: '', name: 'profile.details', component: () => import('../../views/client/ProfileDetails.vue')},

            /** TODO: сделать уведомления */
            // {
            //     path: 'notification',
            //     name: 'profile.notification',
            //     component: () => import('../views/client/ProfileNotification.vue'),
            // },
            {
                path: 'edit',
                name: 'profile.edit',
                component: () => import('../../views/client/EditProfile.vue'),
            },
        ],
    },
    {
        path: '/user/:id',
        name: 'user.profile',
        component: () => import('../../views/client/UserProfile.vue'),
        meta: {
            layout: Client,
        }
    },

    // Auth
    {
        path: '/sign-in',
        name: 'auth.signIn',
        component: () => import('../../views/auth/SignIn.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/sign-up',
        name: 'auth.signUp',
        component: () => import('../../views/auth/SignUp.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/forgot-password',
        name: 'auth.password.forgot',
        component: () => import('../../views/auth/ForgotPassword.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/password/reset/:hash',
        name: 'auth.password.reset',
        component: () => import('../../views/auth/ResetPassword.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/:catchAll(.*)',
        name: 'error.404',
        component: () => import('../../views/auth/404.vue'),
        meta: {
            layout: Auth,
        },
    },
];

export default routes;
