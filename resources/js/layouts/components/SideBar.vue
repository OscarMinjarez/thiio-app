<template>
    <v-navigation-drawer
        expand-on-hover
        rail
    >
        <v-list>
            <v-list-item
                prepend-avatar="https://upload.wikimedia.org/wikipedia/commons/9/95/Vue.js_Logo_2.svg"
                :subtitle="email"
                :title="name"
            ></v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list density="compact" nav>
            <v-list-item prepend-icon="mdi-logout" title="Logout" value="logout" @click="logout()"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import AuthService from "../../services/AuthService";

const router = useRouter();
const authService = new AuthService(router);

const name = ref(sessionStorage.getItem("user"));
const email = ref(sessionStorage.getItem("email"));

const logout = () => {
    authService.logout();
}

</script>