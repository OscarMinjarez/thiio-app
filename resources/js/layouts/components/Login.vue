<template>
    <div>
        <v-card
            class="mx-auto pa-12 pb-8"
            elevation="8"
            rounded="lg"
            min-width="500"
        >
            <div class="text-subtitle-1 text-medium-emphasis">Account</div>
    
            <v-form ref="form">
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
            </v-form>
    
            <v-btn
                class="my-3"
                size="large"
                variant="tonal"
                block
                @click="login()"
            >
                Log In
            </v-btn>
    
            <v-card-text class="text-center">
                <a
                    class="text-blue text-decoration-none"
                    href="#"
                    rel="noopener noreferrer"
                    target="_blank"
                >
                    Sign up now <v-icon icon="mdi-chevron-right"></v-icon>
                </a>
            </v-card-text>
        </v-card>
    </div>
</template>

<script setup>
import { ref } from "vue";
import AuthService from "../../services/AuthService";

const authService = new AuthService();

const form = ref(null);
const visible = ref(false);

const email = ref("");
const password = ref("");

const rules = {
    required: value => !!value || "Required",
    email: value => {
        const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return pattern.test(value) || 'Invalid email.';
    }
};

const login = () => {
    if (form.value.validate()) {
        const user = {
            email: email.value,
            password: password.value
        };
        authService.login(user);
        return;
    }
    console.log("Form is invalid");
}
</script>