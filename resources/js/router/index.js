import {createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),

    routes:[
        {
            path: '/',
            name: 'main',
            component: () => import('../views/Main.vue'),
        },
        { path: '/:pathMatch(.*)*',
            component: () => import('../views/404.vue'),
            name: '404',
        },
    ]
});

export default router;
