<template>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Редактирование цвета</h3>

            <Alert :errors="errors"/>
            <Success :message="message"/>

            <form @submit="update">

                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Название услуги" v-model:value="service.name" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Checkbox title="Услуга активна" name="enabled" v-model:checked="service.is_active"
                              :checked="service.is_active"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Единица измерения" v-model:value="service.unit" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Checkbox title="Услуга предоставляется только с водителем?" name="enabled" v-model:checked="service.with_driver"
                              :checked="service.with_driver"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <Checkbox title="Стоимость услуги одинакова для всех карт лояльности?" name="enabled" v-model:checked="service.uniform_cost_for_cards"
                              :checked="service.uniform_cost_for_cards"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Услуга доступна при заказе от количества часов" v-model:value="service.available_from_hours" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Услуга доступна при заказе до количества часов" v-model:value="service.available_to_hours" type="text"/>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <TextInput title="Наименование услуги для указания в счете" v-model:value="service.invoice_name" type="text"/>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <router-link to="/Services" type="button"
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
import {ServiceService} from "../../services/ServiceService";
import Alert from "../forms/Alert.vue";
import Success from "../forms/Success.vue";
import TextInput from "../forms/TextInput.vue";
import Checkbox from "../forms/Checkbox.vue";

export default {
    name: "ServiceEditForm",
    components: {Checkbox, TextInput, Success, Alert},
    data: function () {
        return {
            loading: false,
            id: this.$route.params.id,
            service: {
                'name': '',
                'photo': '',
                'unit': '',
                'with_driver': false,
                'uniform_cost_for_cards': false,
                'is_active': true,
                'available_from_hours': '',
                'available_to_hours': '',
                'invoice_name': '',
            },
            errors: null,
            message: null
        }
    },
    created() {
        this.Service = this.getData(this.id)
    },
    methods: {
        closeNotify: function () {
            this.errors = null
        },
        getData: async function (id) {
            ServiceService.getById(id)
                .then(response => this.service = response.data.service)
                .catch(error => {
                    this.errors = error.response.data.message
                })
        },
        update: async function (event) {
            event.preventDefault()
            this.errors = null
            ServiceService.update(this.service)
                .then(response => {
                    this.Service = response.data.service
                    this.message = "Изменения сохранены"
                })
                .catch(error => {
                    this.errors = error.response.data.message
                })
        }
    }
}
</script>
