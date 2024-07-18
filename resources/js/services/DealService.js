import axios from "axios";

export class DealService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getDeals(){
        let url = `${this.serverUrl}/deals`;
        return axios.get(url);
    }

    static store(deal) {
        let url = `${this.serverUrl}/deals`;
        return axios.post(url, deal)
    }

    static update(deal) {
        let url = `${this.serverUrl}/deals/${deal.id}`;
        return axios.put(url, deal)
    }

    static getById(id) {
        let url = `${this.serverUrl}/deals/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/deals/${id}`;
        return axios.delete(url)
    }

    static dict() {
        let url = `${this.serverUrl}/deals/dict`;
        return axios.get(url)
    }
}
