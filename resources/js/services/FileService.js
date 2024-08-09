import axios from "axios";

export class FileService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getFiles(modelType, modelId) {
        let url = `${this.serverUrl}/files/${modelType}/${modelId}`;
        return axios.get(url);
    }

    static getFileById(id) {
        let url = `${this.serverUrl}/files/${id}`;
        return axios.get(url);
    }

    static store(modelType, modelId, file) {
        let url = `${this.serverUrl}/files/${modelType}/${modelId}`;
        return axios.post(url, file);
    }

    static download(id) {
        let url = `${this.serverUrl}/files/download/${id}`;
        return axios.get(url, { responseType: 'blob' });
    }

    static delete(id) {
        let url = `${this.serverUrl}/files/${id}`;
        return axios.delete(url);
    }
}
