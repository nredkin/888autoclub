import axios from "axios";

export class EmployeeService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getEmployees(page, query){
        let url = `${this.serverUrl}/employees?page=` + page + `&query=` + query;
        return axios.get(url);
    }

    static getAllEmployees(){
        let url = `${this.serverUrl}/employees/getAllEmployees`;
        return axios.get(url);
    }

    static store(employee) {
        let url = `${this.serverUrl}/employees`;
        return axios.post(url, employee)
    }
    static update(employee) {
        let url = `${this.serverUrl}/employees/${employee.id}`;
        return axios.put(url, employee)
    }

    static delete(id) {
        let url = `${this.serverUrl}/employees/${id}`;
        return axios.delete(url, id)
    }

    static getById(id) {
        let url = `${this.serverUrl}/employees/${id}`;
        return axios.get(url)
    }
    static currentEmployee()
    {
        let url = `${this.serverUrl}/employee`;
        return axios.get(url)
    }
}
