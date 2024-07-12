import { createRouter, createWebHistory } from "vue-router";
import Home from "./layouts/pages/Home.vue";
import Dashboard from "./layouts/pages/Dashboard.vue";
import Login from "./layouts/components/Login.vue";
import Register from "./layouts/components/Register.vue";

const routes = [
    { path: "/", redirect: { name: "Login" } },
    { path: "/:catchAll(.*)", redirect: { name: "Login" } },
    { path: "/home", name: "Home", component: Home, children: [
        { path: "", redirect: "login" },
        { name: "Login", path: "login", component: Login },
        { name: "Register", path: "register", component: Register }
      ] 
    },
    { path: "/dashboard", name: "Dashboard", component: Dashboard, meta: { requiresAuth: true } }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuthenticated = sessionStorage.getItem('token') !== null;
    if (to.matched.some(record => record.meta.requiresAuth) && !isAuthenticated) {
        next({ name: "Login" });
    } else {
        next();
    }
});

export default router;