import axios from "axios";

export class CategoryService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getCategories(){
        let url = `${this.serverUrl}/categories`;
        return axios.get(url);
    }

    static store(category) {
        let url = `${this.serverUrl}/categories`;
        return axios.post(url, category)
    }

    static update(category) {
        let url = `${this.serverUrl}/categories/${category.id}`;
        return axios.put(url, category)
    }

    static getById(id) {
        let url = `${this.serverUrl}/categories/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/categories/${id}`;
        return axios.delete(url)
    }

    static dict() {
        let url = `${this.serverUrl}/categories/dict`;
        return axios.get(url)
    }
}
