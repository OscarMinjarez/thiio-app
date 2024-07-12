<template>
    <v-app>
        <SideBar v-if="shouldShowSidebar"></SideBar>
        <Navbar></Navbar>
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script setup>
import SideBar from "./components/SideBar.vue";
import Navbar from "./components/Navbar.vue";
import { useRoute } from 'vue-router';
import { ref, computed } from "vue";

const route = useRoute();

const shouldShowSidebar = computed(() => {
    return route.path === "/dashboard";
});
</script>