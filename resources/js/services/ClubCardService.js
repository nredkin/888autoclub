import axios from "axios";

export class ClubCardService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getClubCards(clientId){
        let url = `${this.serverUrl}/clubCards/${clientId}`;
        return axios.get(url);
    }

    static store(clubCard) {
        let url = `${this.serverUrl}/clubCards`;
        return axios.post(url, clubCard)
    }

    static update(clubCard) {
        let url = `${this.serverUrl}/clubCards/${clubCard.id}`;
        return axios.put(url, clubCard)
    }

    static delete(id) {
        let url = `${this.serverUrl}/clubCards/${id}`;
        return axios.delete(url)
    }
}
