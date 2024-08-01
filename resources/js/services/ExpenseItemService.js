import axios from "axios";

export class ExpenseItemService {
    static serverUrl = import.meta.env.VITE_BASE_URL;

    static getExpenseItems(){
        let url = `${this.serverUrl}/expenseItems`;
        return axios.get(url);
    }

    static store(expenseItem) {
        let url = `${this.serverUrl}/expenseItems`;
        return axios.post(url, expenseItem)
    }

    static update(expenseItem) {
        let url = `${this.serverUrl}/expenseItems/${expenseItem.id}`;
        return axios.put(url, expenseItem)
    }

    static getById(id) {
        let url = `${this.serverUrl}/expenseItems/${id}`;
        return axios.get(url)
    }

    static delete(id) {
        let url = `${this.serverUrl}/expenseItems/${id}`;
        return axios.delete(url)
    }
}
