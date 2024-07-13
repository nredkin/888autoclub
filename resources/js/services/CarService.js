import axios from "axios";

export class CarService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getCars(){
        let url = `${this.serverUrl}/cars`;
        return axios.get(url);
    }

    static store(car) {
        let url = `${this.serverUrl}/cars`;
        return axios.post(url, car)
    }

    static update(car) {
        let url = `${this.serverUrl}/cars/${car.id}`;
        return axios.put(url, car)
    }

    static getById(id) {
        let url = `${this.serverUrl}/cars/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/cars/${id}`;
        return axios.delete(url)
    }

    static dict() {
        let url = `${this.serverUrl}/cars/dict`;
        return axios.get(url)
    }
}
