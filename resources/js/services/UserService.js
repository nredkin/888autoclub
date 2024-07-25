import axios from "axios";

export class UserService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getUsers(page, query){
        let url = `${this.serverUrl}/users?page=` + page + `&query=` + query;
        return axios.get(url);
    }

    static getAllUsers(){
        let url = `${this.serverUrl}/users/getAllUsers`;
        return axios.get(url);
    }

    static store(user) {
        let url = `${this.serverUrl}/users`;
        return axios.post(url, user)
    }
    static update(user) {
        let url = `${this.serverUrl}/users/${user.id}`;
        return axios.put(url, user)
    }

    static delete(id) {
        let url = `${this.serverUrl}/users/${id}`;
        return axios.delete(url, id)
    }

    static getById(id) {
        let url = `${this.serverUrl}/users/${id}`;
        return axios.get(url)
    }

    static currentUser()
    {
        let url = `${this.serverUrl}/user`;
        return axios.get(url)
    }

    static getRoles()
    {
        let url = `${this.serverUrl}/roles`;
        return axios.get(url)
    }

    static getManagersList()
    {
        let url = `${this.serverUrl}/users/managers`;
        return axios.get(url)
    }

    static getAdminsList()
    {
        let url = `${this.serverUrl}/users/admins`;
        return axios.get(url)
    }

    static getClientsList()
    {
        let url = `${this.serverUrl}/users/clients`;
        return axios.get(url)
    }

    static downloadContract(id) {
        let url = `${this.serverUrl}/users/contract/${id}`;
        return axios.get(url, {responseType: 'blob'})
    }
}
