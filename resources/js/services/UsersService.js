import { URL } from "../utils/constants";
import HttpClient from "../utils/HttpClient";

export default class UsersService {

    constructor() {
        this.httpClient = new HttpClient(URL);
    }

    getUsers = async () => {
        try {
            const response = await this.httpClient.get("api/users", {
                "Accept": "application/json",
                "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGgvbG9naW4iLCJpYXQiOjE3MjA3MjYxNDcsImV4cCI6MTcyMDcyOTc0NywibmJmIjoxNzIwNzI2MTQ3LCJqdGkiOiJudDNzM1lFdVc2aUxqTlJrIiwic3ViIjoiNCIsInBydiI6IjIzYmQ1Yzg5NDlmNjAwYWRiMzllNzAxYzQwMDg3MmRiN2E1OTc2ZjcifQ.xwpADYC61bgbIocsj1ybfiZJwjuOc9bJoTJEH24iAec"
            });
            return response.users;
        } catch (e) {
            console.error(e);   
        }
    }
}