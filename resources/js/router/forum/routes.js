import Client from "../../layouts/Client.vue";
import Auth from "../../layouts/Auth.vue";
import Middleware from "../../middleware";

const routes = [
    // Forum
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
        path: '/search/:search?',
        name: 'forum.search',
        component: () => import('../../views/client/Search.vue'),
        meta: {
            layout: Client,
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
        path: '/not-found',
        name: 'error.404',
        component: () => import('../../views/client/NotFound.vue'),
        meta: {
            layout: Client,
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
            {
                path: 'notification',
                name: 'profile.notification',
                component: () => import('../../views/client/ProfileNotification.vue'),
            },
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
        path: '/login',
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
        path: '/password/reset/:hash:expires:signature',
        name: 'auth.password.reset',
        component: () => import('../../views/auth/ResetPassword.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/authorize/:provider/callback',
        name: 'auth.provider',
        component: () => import('../../views/auth/AuthWithProvider.vue'),
        meta: {
            layout: Auth,
            middleware: [Middleware.guest]
        },
    },
    {
        path: '/email/verify/:id/:hash',
        name: 'auth.email.verify',
        component: () => import('../../views/auth/EmailVerified.vue'),
        meta: {
            layout: Auth,
            // middleware: [Middleware.guest]
        },
    },
    // {
    //     path: '/:catchAll(.*)',
    //     name: 'error.404',
    //     component: () => import('../../views/auth/404.vue'),
    //     meta: {
    //         layout: Auth,
    //     },
    // },
    {
        path: '/login',
        beforeEnter: () => {
            window.location.href = '/sign-in';
        }
    },
    {
        path: '/register',
        beforeEnter: () => {
            window.location.href = '/sign-up';
        }
    },
];

export default routes;
