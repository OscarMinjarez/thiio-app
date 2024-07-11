<template>
    <v-app>
        <SideBar></SideBar>
        <Navbar></Navbar>
        <v-main>
            <router-view></router-view>
        </v-main>
    </v-app>
</template>

<script setup>
import SideBar from "./components/SideBar.vue";
import Navbar from "./components/Navbar.vue";
</script>