import { createRouter, createWebHistory } from "vue-router";
import Home from "./layouts/pages/Home.vue";
import Dashboard from "./layouts/pages/Dashboard.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: "/", name: "Home", component: Home },
        { path: "/dashboard", name: "Dashboard", component: Dashboard }
    ]
});

export default router;