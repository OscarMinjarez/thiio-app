import { createRouter, createWebHistory } from "vue-router";
import Home from "./layouts/pages/Home.vue";
import Dashboard from "./layouts/pages/Dashboard.vue";

const routes = [
    { path: "/", redirect: { name: "Home" } },
    { path: "/:catchAll(.*)", redirect: { name: "Home" } },
    { path: "/home", name: "Home", component: Home },
    { path: "/dashboard", name: "Dashboard", component: Dashboard, meta: { requiresAuth: true } }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = sessionStorage.getItem('token') !== null;
    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
        next({ name: 'Home' });
    } else {
        next();
    }
});

export default router;