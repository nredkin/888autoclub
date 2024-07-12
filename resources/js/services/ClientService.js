import axios from "axios";
import {filter} from "lodash/collection";

export class ClientService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getClients(query){
        let url = `${this.serverUrl}/clients`;
        return axios.get(url, {"params": {"query": query}});
    }

    static store(client) {
        let url = `${this.serverUrl}/clients`;
        return axios.post(url, client)
    }

    static update(client) {
        let url = `${this.serverUrl}/clients/${client.id}`;
        return axios.put(url, client)
    }

    static getById(id) {
        let url = `${this.serverUrl}/clients/${id}`;
        return axios.get(url)
    }

    static download(path) {
        return axios.get(path, {responseType: 'blob'})
    }

    static upload(file, id) {
        let formData = new FormData();
        formData.append('file', file)
        let url = `${this.serverUrl}/clients/${id}/upload`;
        return axios.post(url, formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        })
    }

    static deleteFile(clientId, fileId) {
        let url = `${this.serverUrl}/clients/${clientId}/delete-file/${fileId}`;
        return axios.delete(url)
    }

    static delete(clientId) {
        let url = `${this.serverUrl}/clients/${clientId}`;
        return axios.delete(url, clientId)
    }
}
