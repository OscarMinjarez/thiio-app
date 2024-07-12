<template>
    <v-app-bar :elevation="0">
        <template v-slot:append>
            <CreateUser></CreateUser>
        </template>
    </v-app-bar>
</template>

<script setup>
import CreateUser from "./CreateUser.vue";
</script>