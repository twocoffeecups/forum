import {createRouter, createWebHistory} from 'vue-router'
import routes from "./routes";
import store from "../../store";

const router = createRouter({
    history: createWebHistory(import.meta.env.VITE_BASE_URL || "/"),
    // linkActiveClass: 'active ms-0',
    routes,
});

router.beforeEach((to, from, next) => {
    if (!to.meta.middleware) {
        return next()
    }
    const middleware = to.meta.middleware;

    const context = {
        to,
        from,
        next,
        store
    }

    return middleware[0]({
        ...context,
    })
})

export default router;
