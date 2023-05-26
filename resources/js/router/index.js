import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes:[
        {
            path: '/',
            name: 'main',
            component: () => import('../client/view/Main.vue'),
        },
        {
            path: '/admin/dashboard',
            name: 'admin.dashboard',
            component: () => import('../admin/view/dashboard/Index.vue'),
            children:[
                {
                    path: 'main',
                    name: 'dashboard.index',
                    component: () => import('../admin/view/dashboard/Main.vue')
                },
                {
                    path: 'user',
                    name: 'dashboard.user',
                    component: () => import('../admin/view/dashboard/User.vue')
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
        // {
        //     path: '/admin/auth',
        //     name: 'admin.auth',
        //     component: () => import('../admin/view/auth/Index.vue'),
        //     children:[
        //         {
        //             path: 'login',
        //             name: 'admin.login',
        //             component: () => import('../admin/view/auth/Login.vue')
        //         },
        //         {
        //             path: 'registration',
        //             name: 'admin.registration',
        //             component: () => import('../admin/view/auth/Register.vue')
        //         },
        //     ]
        // },
        {
            path: '/:pathMatch(.*)*',
            component: () => import('../client/view/404.vue'),
            name: 'main.404',
        },
    ]
});

export default router;
