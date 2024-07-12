import { URL } from "../utils/constants";
import HttpClient from "../utils/HttpClient";

export default class UsersService {

    constructor() {
        this.httpClient = new HttpClient(URL);
    }

    getUsers = async () => {
        try {
            const response = await this.httpClient.get("api/users", {
                "Authorization": `Bearer ${localStorage.getItem("token")}`
            });
            return response.users;
        } catch (e) {
            console.error(e);   
        }
    }
}