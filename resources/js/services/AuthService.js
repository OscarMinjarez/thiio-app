import { URL } from "../utils/constants";
import HttpClient from "../utils/HttpClient";

export default class AuthService {
    
    constructor() {
        this.httpClient = new HttpClient(URL);
    }

    login = async (user) => {
        try {
            const response = await this.httpClient.post(`api/auth/login`, user);
            localStorage.setItem("token", response.access_token);
            return response.user;
        } catch (e) {
            console.error(e);
        }
    }
}