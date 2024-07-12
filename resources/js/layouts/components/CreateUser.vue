<template>
    <div class="pa-4 text-center">
        <v-dialog
            v-model="dialog"
            max-width="400"
        >
            <template v-slot:activator="{ props: activatorProps }">
                <v-btn
                    class="mr-5 text-none font-weight-regular"
                    prepend-icon="mdi-account-edit"
                    text="Create user"
                    variant="tonal"
                    v-bind="activatorProps"
                ></v-btn>
            </template>

            <v-card
                prepend-icon="mdi-account"
                title="Create user"
            >
                <v-card-text>
                    <v-form>
                        <v-row dense>
                            <v-col>
                                <v-text-field
                                    density="compact"
                                    placeholder="Enter your username"
                                    prepend-inner-icon="mdi-account-outline"
                                    variant="outlined"
                                    v-model="name"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row dense>
                            <v-col>
                                <v-text-field
                                    density="compact"
                                    placeholder="Enter your email address"
                                    prepend-inner-icon="mdi-email-outline"
                                    variant="outlined"
                                    v-model="email"
                                    :rules="[rules.required, rules.email]"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row dense>
                            <v-col>
                                <v-text-field
                                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                                    :type="visible ? 'text' : 'password'"
                                    density="compact"
                                    placeholder="Enter your password"
                                    prepend-inner-icon="mdi-lock-outline"
                                    variant="outlined"
                                    @click:append-inner="visible = !visible"
                                    v-model="password"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                        <v-row dense>
                            <v-col>
                                <v-text-field
                                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                                    :type="visible ? 'text' : 'password'"
                                    density="compact"
                                    placeholder="Confirm your password"
                                    prepend-inner-icon="mdi-lock-outline"
                                    variant="outlined"
                                    @click:append-inner="visible = !visible"
                                    v-model="confirmPassword"
                                    :rules="[rules.required]"
                                ></v-text-field>
                            </v-col>
                        </v-row>
                    </v-form>
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>

                    <v-btn
                        text="Close"
                        variant="plain"
                        @click="dialog = false"
                    ></v-btn>

                    <v-btn
                        text="Save"
                        variant="tonal"
                        @click="dialog = false"
                    ></v-btn>
                </v-card-actions>

            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import { ref } from "vue";

const dialog = ref(false);

const name = ref(null);
const email = ref(null);
const password = ref(null);
const confirmPassword = ref(null);

const rules = {
    required: value => !!value || "Required",
    email: value => {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(value) || 'Invalid email.';
    }
};
</script>