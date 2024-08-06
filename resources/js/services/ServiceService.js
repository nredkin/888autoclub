import axios from "axios";

export class ServiceService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getServices(){
        let url = `${this.serverUrl}/services`;
        return axios.get(url);
    }

    static getServicesByDealId(dealId){
        let url = `${this.serverUrl}/services/deal/${dealId}`;
        return axios.get(url);
    }

    static store(service) {
        let url = `${this.serverUrl}/services`;
        return axios.post(url, service)
    }

    static update(service) {
        let url = `${this.serverUrl}/services/${service.id}`;
        return axios.put(url, service)
    }

    static getById(id) {
        let url = `${this.serverUrl}/services/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/services/${id}`;
        return axios.delete(url)
    }


}
