import axios from "axios";

export class BranchService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getBranches(){
        let url = `${this.serverUrl}/branches`;
        return axios.get(url);
    }

    static store(branch) {
        let url = `${this.serverUrl}/branches`;
        return axios.post(url, branch)
    }

    static update(branch) {
        let url = `${this.serverUrl}/branches/${branch.id}`;
        return axios.put(url, branch)
    }

    static getById(id) {
        let url = `${this.serverUrl}/branches/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/branches/${id}`;
        return axios.delete(url)
    }

    static dict() {
        let url = `${this.serverUrl}/branches/dict`;
        return axios.get(url)
    }
}
