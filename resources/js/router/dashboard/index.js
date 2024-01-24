import {createRouter, createWebHistory} from 'vue-router'
import routes from "./routes";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    // linkActiveClass: 'active ms-0',
    routes,
});

export default router;
