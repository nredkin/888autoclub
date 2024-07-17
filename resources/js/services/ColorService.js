import axios from "axios";

export class ColorService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getColors(){
        let url = `${this.serverUrl}/colors`;
        return axios.get(url);
    }

    static store(color) {
        let url = `${this.serverUrl}/colors`;
        return axios.post(url, color)
    }

    static update(color) {
        let url = `${this.serverUrl}/colors/${color.id}`;
        return axios.put(url, color)
    }

    static getById(id) {
        let url = `${this.serverUrl}/colors/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/colors/${id}`;
        return axios.delete(url)
    }

    static dict() {
        let url = `${this.serverUrl}/colors/dict`;
        return axios.get(url)
    }
}
