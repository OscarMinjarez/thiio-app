export default class HttpClient {

    constructor(BASE_URL) {
        this.BASE_URL = BASE_URL;
    }

    request = async (url, method, data = null, headers = {}) => {
        const options = {
            method,
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json",
                ...headers
            }
        };
        if (data) {
            options.body = JSON.stringify(data);
        }
        try {
            const response = await fetch(`${this.BASE_URL}/${url}`, options);
            if (!response) {
                throw new Error(`HTTP Error! Status: ${response.message}`);
            }
            return await response.json();
        } catch (e) {
            throw new Error(e);
        }
    }

    get = (url, headers = {}) => this.request(url, "GET", null, headers);
    post = (url, data, headers = {}) => this.request(url, "POST", data, headers);
    patch = (url, data, headers = {}) => this.request(url, "PATCH", data, headers);
    delete = (url, headers = {}) => this.request(url, "DELETE", null, headers);
}