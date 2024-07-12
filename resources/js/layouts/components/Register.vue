<template>
    <div>
        <v-card
            class="mx-auto pa-12 pb-8"
            elevation="8"
            rounded="lg"
            min-width="500"
            prepend-icon="mdi-account"
            title="Register"
        >
        
            <v-form ref="form">
                <div class="text-subtitle-1 text-medium-emphasis">Username</div>
                
                <v-text-field
                    density="compact"
                    placeholder="Username"
                    prepend-inner-icon="mdi-email-outline"
                    variant="outlined"
                    v-model="name"
                    :rules="[rules.required]"
                ></v-text-field>

                <div class="text-subtitle-1 text-medium-emphasis">Account</div>

                <v-text-field
                    density="compact"
                    placeholder="Email address"
                    prepend-inner-icon="mdi-email-outline"
                    variant="outlined"
                    v-model="email"
                    :rules="[rules.required, rules.email]"
                ></v-text-field>
        
                <div class="mt-5 text-subtitle-1 text-medium-emphasis">Password</div>
        
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

                <div class="mt-5 text-subtitle-1 text-medium-emphasis">Confirm your password</div>
        
                <v-text-field
                    :append-inner-icon="visible ? 'mdi-eye-off' : 'mdi-eye'"
                    :type="visible ? 'text' : 'password'"
                    density="compact"
                    placeholder="Enter your password"
                    prepend-inner-icon="mdi-lock-outline"
                    variant="outlined"
                    @click:append-inner="visible = !visible"
                    v-model="confirmPassword"
                    :rules="[rules.required]"
                ></v-text-field>
            </v-form>

            <v-alert
                v-if="errorMessage"
                type="error"
                dismissible
                class="my-3"
            >
                {{ errorMessage }}
            </v-alert>
    
            <v-btn
                class="my-3"
                size="large"
                variant="tonal"
                block
                @click="register()"
            >
                Register
            </v-btn>
    
            <v-card-text class="text-center">
                Have an account?
                <router-link to="/home/login" class="text-blue text-decoration-none">
                    Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
                </router-link>
            </v-card-text>
        </v-card>

        <v-dialog v-model="showDialog" width="auto">
            <v-card max-width="400" prepend-icon="mdi-check-circle" :text="dialogMessage" :title="dialogTitle">
                <template v-slot:actions>
                    <v-btn class="ms-auto" text="Ok" @click="handleOk"></v-btn>
                </template>
            </v-card>
        </v-dialog>
    </div>
</template>

<script setup>
import { ref } from "vue";
import AuthService from "../../services/AuthService";
import { useRouter } from "vue-router";

const router = useRouter();
const authService = new AuthService(router);

const name = ref("");
const email = ref("");
const password = ref("");
const confirmPassword = ref("");

const form = ref(null);
const visible = ref(false);

const showDialog = ref(false);
const dialogTitle = ref("");
const dialogMessage = ref("");

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
            showDialog.value = true;
            dialogTitle.value = "Registration Successful";
            dialogMessage.value = "Your account has been successfully registered. You can sing in now.";
        } catch (e) {
            errorMessage.value = e.message.replace(/^Error: /, "").replace(/^Error: /, "");
        }
    }
}

const handleOk = () => {
    showDialog.value = false;
    router.push("/home/login");
}
</script>