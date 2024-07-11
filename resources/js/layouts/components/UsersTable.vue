<template>
    <v-table fixed-header class="border-thin">
        <thead>
            <tr>
                <th class="text-left">
                    User name
                </th>
                <th class="text-left">
                    Email
                </th>
                <th class="text-center">
                    Verified
                </th>
                <th class="text-center v-col-2">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="user in users" :key="user.id">
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td class="text-center">{{ user.verified ? 'Yes' : 'No' }}</td>
                <td class="text-center pa-2">
                    <v-btn
                        icon="mdi-pencil"
                        class="mx-1"
                        color="blue"
                        @click="handleEdit(user.id)"
                    ></v-btn>
                    <v-btn
                        icon="mdi-delete"
                        class="mx-1"
                        color="red"
                        @click="handleDelete(user.id)"
                        ></v-btn>
                </td>
            </tr>
        </tbody>
    </v-table>
</template>

<script setup>
import { defineProps, defineEmits } from "vue";

const props = defineProps({
    users: {
        type: Array,
        required: true
    }
});

const emits = defineEmits(["edit", "delete"]);

const handleEdit = (id) => {
  console.log('Edit user with ID:', id);
};

const handleDelete = (id) => {
  console.log('Delete user with ID:', id);
};
</script>