import axios from "axios";

export class ClubCardLevelService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getClubCardLevels(){
        let url = `${this.serverUrl}/clubCardLevels`;
        return axios.get(url);
    }

    static getById(id) {
        let url = `${this.serverUrl}/clubCardLevels/${id}`;
        return axios.get(url)
    }

    static dict() {
        let url = `${this.serverUrl}/clubCardLevels/dict`;
        return axios.get(url)
    }
}
