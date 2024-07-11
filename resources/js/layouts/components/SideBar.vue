<template>
    <v-navigation-drawer
        expand-on-hover
        rail
    >
        <v-list>
            <v-list-item
                prepend-avatar="https://randomuser.me/api/portraits/women/85.jpg"
                subtitle="sandra_a88@gmailcom"
                title="Sandra Adams"
            ></v-list-item>
        </v-list>

        <v-divider></v-divider>

        <v-list density="compact" nav>
            <v-list-item prepend-icon="mdi-account-outline" title="Profile" value="profile"></v-list-item>
            <v-list-item prepend-icon="mdi-view-dashboard-outline" title="Dashboard" value="dashboard"></v-list-item>
            <v-list-item prepend-icon="mdi-logout" title="Logout" value="logout"></v-list-item>
        </v-list>
    </v-navigation-drawer>
</template>