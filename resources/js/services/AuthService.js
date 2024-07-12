import { URL } from "../utils/constants";
import HttpClient from "../utils/HttpClient";

export default class AuthService {
    
    constructor() {
        this.httpClient = new HttpClient(URL);
    }

    login = async (user) => {
        try {
            const response = await this.httpClient.post(`api/auth/login`, user);
            sessionStorage.setItem("id", response.user.id);
            sessionStorage.setItem("user", response.user.name);
            sessionStorage.setItem("email", response.user.email);
            sessionStorage.setItem("token", response.access_token);
            this.httpClient.redirect("dashboard");
        } catch (e) {
            console.error(e);
        }
    }
}