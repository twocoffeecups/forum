import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes:[
        // client routes
        {
            path: '/',
            name: 'main',
            component: () => import('../client/view/Main.vue'),
        },

        // admin routes
        {
            path: '/admin',
            name: 'admin.dashboard',
            component: () => import('../admin/view/dashboard/Index.vue'),
            children:[
                {
                    path: 'dashboard',
                    name: 'admin.index',
                    component: () => import('../admin/view/dashboard/Main.vue')
                },
                {
                    path: 'role',
                    name: 'user.role',
                    component: () => import('../admin/view/dashboard/Role.vue')
                },
                {
                    path: 'user',
                    name: 'user.users',
                    component: () => import('../admin/view/dashboard/User.vue')
                },
                {
                    path: 'banned-users',
                    name: 'user.banned',
                    component: () => import('../admin/view/dashboard/BannedUsers.vue')
                },
                {
                    path: 'reports',
                    name: 'report.index',
                    component: () => import('../admin/view/dashboard/Reports.vue')
                },
            ]
        },
        {
            path: '/admin/login',
            name: 'admin.login',
            component: () => import('../admin/view/auth/Login.vue')
        },
        {
            path: '/admin/registration',
            name: 'admin.registration',
            component: () => import('../admin/view/auth/Register.vue')
        },
        {
            path: '/:pathMatch(.*)*',
            component: () => import('../client/view/404.vue'),
            name: 'main.404',
        },
    ]
});

export default router;
