<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование сделки</h3>

            <Alert :errors="errors"/>
            <Success :message="message"/>

            <form @submit="update">

                <div class="relative z-1 w-full mb-6 group">
                    <my-select name="branch_id" v-model:value="deal.branch_id" title="Филиал" :values="branches"/>
                </div>
                <div class="relative z-1 w-full mb-6 group">
                    <my-select name="deal_type" v-model:value="deal.deal_type" title="Тип сделки" :values="dealTypes"/>
                </div>
                <div class="relative z-1 w-full mb-6 group">
                    <my-select name="client_id" v-model:value="deal.user_id" title="ФИО клиента" :values="clients" displayField="fullName"/>
                </div>
                <div class="relative z-1 w-full mb-6 group">
                    <my-select name="car_id" v-model:value="deal.car_id" title="Наименование автомобиля" :values="cars" displayField="model"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <DateInput title="Дата договора" name="contract_date" v-model:value="deal.contract_date" type="date"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <DateInput title="Дата и время начала аренды" name="rental_start" v-model:value="deal.rental_start" type="datetime-local"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <DateInput title="Дата и время завершения аренды" name="rental_end" v-model:value="deal.rental_end" type="datetime-local"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Textarea title="Комментарий" name="comment" v-model:value="deal.comment"/>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/deals" type="button"
                                 class="text-sm font-semibold leading-6 text-gray-900">Отмена
                    </router-link>

                    <button type="submit"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Сохранить
                    </button>

                </div>
            </form>

        </div>
    </div>
</template>

<script>
import {DealService} from "../../services/DealService";
import {BranchService} from "../../services/BranchService";
import {CarService} from "../../services/CarService";
import {ClientService} from "../../services/ClientService";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import TextInput from "../forms/TextInput.vue";
import Textarea from "../forms/Textarea.vue";
import DateInput from "../forms/DateInput.vue";
import MySelect from "../forms/MySelect.vue";

export default {
    name: "DealEditForm",
    components: {MySelect, DateInput, Textarea, TextInput, Success, Alert},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            deal: {
                'deal_type': 0,
                'user_id': null,
                'car_id': null,
                'branch_id': null,
                'security_deposit': 0,
                'contract_date': '',
                'rental_start': '',
                'rental_end': '',
                'comment': '',
            },
            branches: [],
            cars: [],
            clients: [],
            dealTypes: [{'id': 0, 'name':'Аренда с экипажем'}, {'id': 1, 'name':'Аренда без экипажа'}],
            errors: null,
            message: null
        }
    },
    created() {
        this.deal = this.getData(this.id)
        BranchService.getBranches().then(response => this.branches = response.data.branches)
        CarService.getCars().then(response => this.cars = response.data.cars)
        ClientService.getClients().then(response => this.clients = response.data.clients)
    },
    methods: {
        closeNotify: function () {
            this.errors = null
        },
        getData: async function (id) {
            DealService.getById(id)
                .then(response => this.deal = response.data.deal)
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            DealService.update(this.deal)
                .then(response => {
                    this.deal = response.data.deal
                    this.message = "Изменения сохранены"
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
