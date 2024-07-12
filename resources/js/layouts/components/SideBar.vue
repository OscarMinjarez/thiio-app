<template>
    <v-navigation-drawer
        expand-on-hover
        rail
    >
        <v-list>
            <v-list-item
                prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                :subtitle="email"
                :title="name"
            ></v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list density="compact" nav>
            <v-list-item prepend-icon="mdi-account-outline" title="Profile" value="profile"></v-list-item>
            <v-list-item prepend-icon="mdi-view-dashboard-outline" title="Dashboard" value="dashboard"></v-list-item>
            <v-list-item prepend-icon="mdi-logout" title="Logout" value="logout" @click="logout()"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
import { ref } from "vue";
import AuthService from "../../services/AuthService";

const authService = new AuthService();

const name = ref(sessionStorage.getItem("user"));
const email = ref(sessionStorage.getItem("email"));

const logout = () => {
    authService.logout();
}

</script>