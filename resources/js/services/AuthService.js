import { URL } from "../utils/constants";
import HttpClient from "../utils/HttpClient";

export default class AuthService {
    
    constructor(router) {
        this.httpClient = new HttpClient(URL, router);
    }

    login = async (user) => {
        try {
            const response = await this.httpClient.post(`api/auth/login`, user);
            if (response.status === "success") {
                sessionStorage.setItem("id", response.user.id);
                sessionStorage.setItem("user", response.user.name);
                sessionStorage.setItem("email", response.user.email);
                sessionStorage.setItem("token", response.access_token);
                this.httpClient.redirect("dashboard");
            } else {
                throw new Error("Login failed");
            }
        } catch (e) {
            throw new Error("Invalid credentials");
        }
    }

    logout = async () => {
        try {
            await this.httpClient.post("api/auth/logout", null, {
                "Authorization": `Bearer ${sessionStorage.getItem("token")}`
            });
            sessionStorage.clear();
            this.httpClient.redirect("home");
        } catch (e) {
            throw new Error(e);
        }
    }

    register = async (newUser) => {
        try {
            const response = await this.httpClient.post(`api/auth/register`, newUser, {
                "Authorization": `Bearer ${sessionStorage.getItem("token")}`
            });
            if (response.errors) {
                const errorKey = Object.keys(response.errors)[0];
                const errorMessage = response.errors[errorKey][0];
                throw new Error(errorMessage);
            }
        } catch (e) {
            throw new Error(e);
        }
    }
}