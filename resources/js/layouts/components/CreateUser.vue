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
                    <v-form ref="form">
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

                <v-alert
                    v-if="errorMessage"
                    type="error"
                    dismissible
                    class="my-3"
                >
                    {{ errorMessage }}
                </v-alert>

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
                        @click="register()"
                    ></v-btn>
                </v-card-actions>

            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import AuthService from "../../services/AuthService";

const router = useRouter();
const authService = new AuthService(router);

const dialog = ref(false);

const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");

const form = ref(null);
const visible = ref(false);

const errorMessage = ref("");

const rules = {
    required: value => !!value || "Required",
    email: value => {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(value) || 'Invalid email.';
    }
};

const register = async () => {
    errorMessage.value = "";
    if (form.value.validate()) {
        const newUser = {
            name: name.value,
            email: email.value,
            password: password.value,
            password_confirmation: confirmPassword.value
        };
        try {
            await authService.register(newUser);
        } catch (e) {
            errorMessage.value = e.message.replace(/^Error: /, "").replace(/^Error: /, "");
        }
    }
}
</script>