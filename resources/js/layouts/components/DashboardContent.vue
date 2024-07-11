<template>
    <v-container class="w-75 pa-0 mt-5">
        <v-container class="py-10">
            <v-row>
                <v-col class="pa-0 mr-5">
                    <v-text-field
                        label="Username"
                        density="compact"
                    ></v-text-field>
                </v-col>
                <v-col class="pa-0 ml-5">
                    <v-text-field
                        label="Email"
                        density="compact"
                    ></v-text-field>
                </v-col>
            </v-row>
            <v-row justify="end">
                <v-btn class="mdi mdi-magnify">Search</v-btn>
            </v-row>
        </v-container>
        <v-container class="pa-0">
            <v-row>
                <v-col>
                    <UsersTable></UsersTable>
                </v-col>
            </v-row>
        </v-container>
    </v-container>
</template>

<script setup>
import UsersTable from "./UsersTable.vue";
</script>