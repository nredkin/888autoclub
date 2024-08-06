import axios from "axios";

export class ServicePriceService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getServicePrices(serviceId){
        let url = `${this.serverUrl}/servicePrices/${serviceId}`;
        return axios.get(url);
    }

    static getServicePricesByCar(carId){
        let url = `${this.serverUrl}/servicePrices/car-services/${carId}/prices`;
        return axios.get(url);
    }

    static store(servicePrice) {
        let url = `${this.serverUrl}/servicePrices`;
        return axios.post(url, servicePrice)
    }

    static update(servicePrice) {
        let url = `${this.serverUrl}/servicePrices/${servicePrice.id}`;
        return axios.put(url, servicePrice)
    }

    static getById(id) {
        let url = `${this.serverUrl}/servicePrices/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/servicePrices/${id}`;
        return axios.delete(url)
    }

    static storeByServiceAndCar(newService, newServicePrices) {
        let url = `${this.serverUrl}/servicePrices/storeByServiceAndCar`;
        return axios.post(url, {newService, newServicePrices})
    }

    static deleteByServiceAndCar(carId, serviceId) {
        let url = `${this.serverUrl}/servicePrices/car-services/${carId}/prices/${serviceId}`;
        return axios.delete(url)
    }

}
