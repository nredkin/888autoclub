import axios from "axios";

export class OperationService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getOperations(){
        let url = `${this.serverUrl}/operations`;
        return axios.get(url);
    }

    static getOperationsByModelId(modelType, modelId) {
        let url = `${this.serverUrl}/operations/${modelType}/${modelId}`;
        return axios.get(url);
    }

    static store(operation) {
        let url = `${this.serverUrl}/operations`;
        return axios.post(url, operation)
    }

    static update(operation) {
        let url = `${this.serverUrl}/operations/${operation.id}`;
        return axios.put(url, operation)
    }

    static getById(id) {
        let url = `${this.serverUrl}/operation/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/operations/${id}`;
        return axios.delete(url)
    }

    static dict() {
        let url = `${this.serverUrl}/operations/dict`;
        return axios.get(url)
    }
}
